<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ProductSoftDeleteTest extends TestCase
{
    public function test_products_table_has_deleted_at_column(): void
    {
        $this->assertTrue(Schema::hasColumn('products', 'deleted_at'));
    }
}
