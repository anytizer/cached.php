<?php
namespace cached;

interface CachedContentInterface
{
	public function CacheExists(string $cache_file): bool;
	public function CacheExpired(string $cache_file): bool;
	public function FreshContent(string $url);
	public function CachedContent(string $cache_file);
	public function WriteCache(string $cache_file, string $content);
}