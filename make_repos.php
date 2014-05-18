#!/usr/bin/env php
<?php
$json = json_decode(file_get_contents('satis.json'), true);
foreach ($json['repositories'] as $repository) {
  $repositories[$repository['url']] = $repository;
}

foreach (explode("\n", file_get_contents('mods')) as $mod) {
  $url = "http://git.drupal.org/project/$mod.git";
  $repositories[$url] = array(
    'url' => $url,
    'type' => 'git'
  );
}
$json['repositories'] = array_values($repositories);
file_put_contents('satis.json', json_encode($json, JSON_PRETTY_PRINT));
