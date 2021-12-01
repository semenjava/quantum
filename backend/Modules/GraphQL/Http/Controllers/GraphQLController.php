<?php

namespace Modules\GraphQL\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GraphQLController extends Controller
{
    // http://localhost:8000/api/v1/graphql/typeDefs
    public function getTypeDefs()
    {
        $typeDefs = file_get_contents(base_path('graphql/schema.graphql'));
        return $typeDefs;
    }
}
