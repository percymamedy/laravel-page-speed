<?php

namespace RenatoMarinho\LaravelPageSpeed\Test\Middleware;

use RenatoMarinho\LaravelPageSpeed\Test\TestCase;
use RenatoMarinho\LaravelPageSpeed\Middleware\CollapseWhitespace;

class CollapseWhitespaceTest extends TestCase
{
    protected function getMiddleware()
    {
        $this->middleware = new CollapseWhitespace();
    }

    public function testCollapseWhitespace()
    {
        $response = $this->middleware->handle($this->request, $this->getNext());

        $partial = explode('<title>', $response->getContent());
        $compress = '<!DOCTYPE html><!--[if IE 8]><html lang="en" class="ie8 no-js"><![endif]--><!--[if IE 9]><html lang="en" class="ie9 no-js"><![endif]--><!--[if !IE]><!--><html lang="en"><!--<![endif]--><head><meta charset="utf-8"><meta http-equiv="x-ua-compatible" content="ie=edge">';

        $this->assertSame($compress, trim($partial[0]));
    }
}
