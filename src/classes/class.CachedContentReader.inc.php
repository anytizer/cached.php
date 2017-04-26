<?php

class CachedContentReader implements CachedContentInterface
{
	public function __construct()
	{
	}
	
	public function read(string $cache_file, string $url, int $seconds)
	{
		$content = "";
		if($this->CacheExists($cache_file) && !$this->CacheExpired($cache_file))
		{
			$content = $this->CachedContent($cache_file);
		}
		else
		{
			$content = $this->FreshContent($url);
			$this->WriteCache($cache_file, $content);
		}
		
		return $content;
	}
	
	public function CacheExists(string $cache_file): bool
	{
		//return true;
		
		$cache_exists = is_file($cache_file) && is_writable($cache_file);
		return $cache_exists;
	}
	
	public function CacheExpired(string $cache_file): bool
	{
		$age = 1 * 60 * 60; // 1 hour
		$now = time();
		$old = filemtime($cache_file);
		echo "Diff: ", $diff = $now - $old;
		
		$is_expired = $diff > $age;
		return $is_expired;
		//return true;
	}

	public function FreshContent(string $url): string
	{
		$content = $this->curl_content($url);
		return $content;
	}
	
	public function CachedContent(string $cache_file): string
	{
		$content = file_get_contents($cache_file);
		return $content;
	}
	
	public function WriteCache(string $cache_file, string $content): bool
	{
		$total = file_put_contents($cache_file, $content);
		$success = $total > 0;
		
		return $success;
	}

	private function curl_content(string $url): string
	{
		echo "URLing...: ", $url;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_USERAGENT, "Hosted Content Importer - WP Plugin");
		curl_setopt($ch, CURLOPT_REFERER, "http://www.example.com/");

		$content = curl_exec($ch);
		curl_close($ch);

		return $content;
	}
}
