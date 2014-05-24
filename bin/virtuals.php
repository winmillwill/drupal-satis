#!/usr/bin/env php
<?php

$file = array_pop($argv);
$composer = json_decode(file_get_contents($file), TRUE);
$packages = $composer['packages'];
foreach ($packages as $name => $versions) {
  foreach ($versions as $version => $package) {
    if (isset($package['replace'])) {
      foreach ($package['replace'] as $virtualName => $virtualVersion) {
        if (!array_key_exists($virtualName, $packages)) {
          $virtuals[$virtualName][$version] = [
            'name' => $virtualName,
            'type' => 'metapackage',
            'version' => $version,
            'require' => [
              $name => $version
            ]
          ];
        }
      }
    }
  }
}
$composer['packages'] = array_merge($packages, $virtuals);
file_put_contents($file, json_encode($composer, JSON_PRETTY_PRINT));
