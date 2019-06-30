<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Api Versioning Demo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <h1><a href="https://www.datatype.in/restful-api-versioning-using-inheritance">Version your RESTful APIs like a pro through Inheritance</a></h1>
            <h4>Version 1 APIs</h4>
            <p>1. All songs</p> GET {{route('api.v1.songs.index')}}
            <p>2. Song by id</p> GET {{route('api.v1.songs.show',1)}}
            <p>3. Update a song by id</p> PATCH {{route('api.v1.songs.update',1)}}
            <pre>
            Request Header: Content-Type: application/json
            Request Body:
            {
                "title": "Faded",
                "artist": "Alan Walker"
            }
            </pre>
            <h4>Version 2 APIs</h4>
            <p>1. All songs</p> GET {{route('api.v2.songs.index')}}
            <p>2. Song by id</p> GET {{route('api.v2.songs.show',1)}}
            <p>3. Update a song by id</p> PATCH {{route('api.v2.songs.update',1)}}
            <pre>
            Request Header: Content-Type: application/json
            Request Body:
            {
                "title": "Faded",
                "artist": "Alan Walker"
            }
            </pre>
            <p>3. Add a new song</p> POST {{route('api.v2.songs.store')}}
            <pre>
            Request Header: Content-Type: application/json
            Request Body:
            {
                "title": "Hymn for the weekend",
                "artist": "Coldplay",
                "genre": "pop",
                "duration": 500
            }
            </pre>
        </div>
    </body>
</html>
