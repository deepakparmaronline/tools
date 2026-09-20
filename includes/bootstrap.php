<?php
declare(strict_types=1);
const SITE_NAME = 'ToolboxKart';
const SITE_URL = 'https://toolboxkart.tech';
const SITE_AUTHOR = 'Deepak Parmar';
$catalog = require __DIR__.'/../data/catalog.php';
foreach (glob(__DIR__.'/../data/catalog-*.php') ?: [] as $catalogFile) {
	$extraCatalog = require $catalogFile;
	$category = $extraCatalog['category'] ?? null;
	if (is_array($category) && isset($category['key'])) {
		$catalog[$category['key']] = $catalog[$category['key']] ?? $category;
	}
	foreach ($extraCatalog['tools'] ?? [] as $tool) {
		$catalog['tools'][] = $tool;
	}
}
$uniqueTools = [];
foreach ($catalog['tools'] as $tool) {
	$uniqueTools[$tool['category'].'/'.$tool['slug']] = $tool;
}
$catalog['tools'] = array_values($uniqueTools);
$toolFiles = glob(__DIR__.'/../*/*.php') ?: [];
$toolFilesByPath = [];
foreach ($toolFiles as $toolFile) {
	$source = file_get_contents($toolFile);
	if (!is_string($source) || !preg_match('/tool_by_path\s*\(\s*[\'\"]([^\'\"]+)[\'\"]\s*,\s*[\'\"]([^\'\"]+)[\'\"]\s*\)/', $source, $toolMatches)) {
		continue;
	}
	[$fullMatch, $categoryKey, $slug] = $toolMatches;
	$toolFilesByPath[$categoryKey.'/'.$slug] = $toolFile;
	if (!isset($catalog[$categoryKey])) {
		$catalog[$categoryKey] = [
			'name' => ucwords(str_replace('-', ' ', $categoryKey)),
			'description' => 'Practical tools and calculators for '.str_replace('-', ' ', $categoryKey).'.',
			'icon' => '▦',
		];
	}
	$toolKey = $categoryKey.'/'.$slug;
	if (!isset($uniqueTools[$toolKey])) {
		$uniqueTools[$toolKey] = [
			'category' => $categoryKey,
			'slug' => $slug,
			'name' => ucwords(str_replace('-', ' ', $slug)),
			'description' => 'A practical '.str_replace('-', ' ', $slug).' tool.',
			'featured' => false,
		];
	}
}
$catalog['tools'] = array_values($uniqueTools);
$posts = require __DIR__.'/../data/posts.php';
require_once __DIR__.'/functions.php';
