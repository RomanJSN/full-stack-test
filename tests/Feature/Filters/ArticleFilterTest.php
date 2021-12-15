<?php

namespace Tests\Feature\Filters;

use App\Models\Articles;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\ArticleFilter;
use App\Filters\QueryFilter;
use Illuminate\Http\Request;
use Mockery\MockInterface;
use Tests\TestCase;

class ArticleFilterTest extends TestCase
{
    protected static function getMethod($name)
    {
        $class = new \ReflectionClass(ArticleFilter::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEmptyRequest()
    {
        $methodFilter = self::getMethod('fields');
        $articleFilter = new ArticleFilter(new Request());

        $this->assertCount(
            1,
            $methodFilter->invokeArgs($articleFilter, array())
        );
    }

    /**
     * @return void
     */
    public function testCallMethodLimitInBuilder()
    {
        $builder = \Mockery::spy(Builder::class);

        $articleFilter = new ArticleFilter(new Request());

        $articleFilter->apply($builder);

        $builder->shouldHaveReceived()->limit(10);
    }

    /**
     * @return void
     */
    public function testCallMethodApply()
    {
        $articleFilter = \Mockery::spy(ArticleFilter::class);

        (new Articles())->filter($articleFilter);

        $articleFilter->shouldHaveReceived('apply');
    }
}
