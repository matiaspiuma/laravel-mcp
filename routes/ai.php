<?php

use Laravel\Mcp\Facades\Mcp;

Mcp::web('/mcp/laravel-shop', \App\Mcp\Servers\LaravelShop::class);
