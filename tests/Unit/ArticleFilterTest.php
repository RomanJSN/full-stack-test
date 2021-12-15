<?php

namespace Tests\Unit;

use App\Filters\ArticleFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class ArticleFilterTest extends TestCase
{
    public function testCallMethodWhereInInBuilder()
    {
        $builder = \Mockery::spy(Builder::class);
        $articleFilterSky = \Mockery::spy(ArticleFilter::class);
        $request = Request::create('/api/articles', 'GET', ['categories' => '1,2,3']);

        $mock = $this->getMockBuilder(ArticleFilter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $reflection = new \ReflectionClass($mock);
        $reflection = $reflection->getProperty('request');
        $reflection->setAccessible(true);
        $reflection->setValue($mock, $request);

        $mock->apply($builder);

        $articleFilterSky->shouldHaveReceived('categories');
        $builder->shouldHaveReceived()->whereIn(10);
    }
}
