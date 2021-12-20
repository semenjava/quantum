<?php

namespace Modules\GraphQL\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use GraphQL\Type\Introspection;

class GraphQLController extends Controller
{
    // http://localhost:8000/api/v1/graphql/typeDefs
    /**
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getTypeDefs()
    {
        $stitcher = new \Nuwave\Lighthouse\Schema\Source\SchemaStitcher(base_path('graphql/schema.graphql'));
        return $stitcher->getSchemaString();
    }
}
