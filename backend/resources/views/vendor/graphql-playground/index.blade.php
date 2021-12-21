<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset=utf-8 />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui">
    <title>GraphQL Playground</title>
    <link rel="stylesheet"
          href="{{\MLL\GraphQLPlayground\DownloadAssetsCommand::cssPath()}}"
    />
    <link rel="shortcut icon"
          href="{{\MLL\GraphQLPlayground\DownloadAssetsCommand::faviconPath()}}"
    />
    <script src="{{\MLL\GraphQLPlayground\DownloadAssetsCommand::jsPath()}}"></script>
</head>
<body>
<div id="root"/>
<script type="text/javascript">
    window.addEventListener('load', function () {
        const root = document.getElementById('root');
        let token = '{{ env('GRAPHQL_PLAYGROUND_API_TOKEN', null) }}';

        console.log(token);

        if (!token) {
            token = window.localStorage.getItem('GRAPHQL_PLAYGROUND_API_TOKEN', null);
        }

        if (!token) {
            token = prompt('Enter API token');
        }

        if (token) {
            window.localStorage.setItem('GRAPHQL_PLAYGROUND_API_TOKEN', token);
        }

        GraphQLPlayground.init(root, {
            endpoint: "{{url(config('graphql-playground.endpoint'))}}",
            subscriptionEndpoint: "{{config('graphql-playground.subscriptionEndpoint')}}",
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });
    });
</script>
</body>
</html>
