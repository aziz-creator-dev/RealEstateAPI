<?php

return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'L5 Swagger UI',
            ],

            'routes' => [
                // Route for accessing the API documentation interface
                'api' => 'api/documentation',
                'docs' => 'docs',  
            ],

            'paths' => [
                // Use absolute path for UI assets (e.g., vendor folder)
                'use_absolute_path' => env('L5_SWAGGER_USE_ABSOLUTE_PATH', true),

                // Path to Swagger UI assets
                'swagger_ui_assets_path' => env('L5_SWAGGER_UI_ASSETS_PATH', 'vendor/swagger-api/swagger-ui/dist/'),

                // Generated JSON documentation filename
                'docs_json' => 'api-docs.json',

                // Generated YAML documentation filename
                'docs_yaml' => 'api-docs.yaml',

                // Choose either JSON or YAML for the documentation format
                'format_to_use_for_docs' => env('L5_FORMAT_TO_USE_FOR_DOCS', 'json'),

                // Path where Swagger annotations are stored
                'annotations' => [
                    base_path('app'),
                ],
            ],
        ],
    ],

    'defaults' => [
        'routes' => [
            // Route for accessing parsed Swagger annotations
            'docs' => 'docs',

            // OAuth2 callback route
            'oauth2_callback' => 'api/oauth2-callback',

            // Middleware to prevent unauthorized access to API documentation
            'middleware' => [
                'api' => [],
                'asset' => [],
                'docs' => [],
                'oauth2_callback' => [],
            ],

            // Route Group options
            'group_options' => [],
        ],

        'paths' => [
            // Absolute path to store parsed annotations
            'docs' => storage_path('api-docs'),

            // Path for exporting Swagger views
            'views' => base_path('resources/views/vendor/l5-swagger'),

            // Set the base path for your API
            'base' => env('L5_SWAGGER_BASE_PATH', null),

            // Directories to exclude from scanning for Swagger annotations
            'excludes' => [],
        ],

        'scanOptions' => [
            'default_processors_configuration' => [
                // Example processor configuration
                // 'operationId.hash' => true,
                // 'pathFilter' => ['tags' => ['/pets/', '/store/']],
            ],

            // Set the analyser for Swagger scanning
            'analyser' => null,

            // Set the analysis for Swagger scanning
            'analysis' => null,

            // Custom query path processors
            'processors' => [
                // new \App\SwaggerProcessors\SchemaQueryParameter(),
            ],

            // File patterns to scan for Swagger annotations
            'pattern' => null,

            // Exclude directories from scanning
            'exclude' => [],

            // OpenAPI spec version
            'open_api_spec_version' => env('L5_SWAGGER_OPEN_API_SPEC_VERSION', \L5Swagger\Generator::OPEN_API_DEFAULT_SPEC_VERSION),
        ],

        'securityDefinitions' => [
            'securitySchemes' => [
                // Example security scheme for API key
                'api_key_security_example' => [
                    'type' => 'apiKey',
                    'description' => 'A short description for the security scheme',
                    'name' => 'api_key',
                    'in' => 'header',
                ],
                // Example security scheme for OAuth2
                'oauth2_security_example' => [
                    'type' => 'oauth2',
                    'description' => 'OAuth2 security scheme description',
                    'flow' => 'implicit',
                    'authorizationUrl' => 'http://example.com/auth',
                    'scopes' => [
                        'read:projects' => 'read your projects',
                        'write:projects' => 'modify projects',
                    ],
                ],
            ],
            'security' => [
                // Example of using security schemes in operations
                // 'api_key_security_example' => [],
                // 'oauth2_security_example' => ['read', 'write'],
            ],
        ],

        'generate_always' => env('L5_SWAGGER_GENERATE_ALWAYS', false),

        'generate_yaml_copy' => env('L5_SWAGGER_GENERATE_YAML_COPY', false),

        'proxy' => false,

        'additional_config_url' => null,

        'operations_sort' => env('L5_SWAGGER_OPERATIONS_SORT', null),

        'validator_url' => null,

        'ui' => [
            'display' => [
                'dark_mode' => env('L5_SWAGGER_UI_DARK_MODE', false),
                'doc_expansion' => env('L5_SWAGGER_UI_DOC_EXPANSION', 'none'),
                'filter' => env('L5_SWAGGER_UI_FILTERS', true),
            ],

            'authorization' => [
                'persist_authorization' => env('L5_SWAGGER_UI_PERSIST_AUTHORIZATION', false),
                'oauth2' => [
                    'use_pkce_with_authorization_code_grant' => false,
                ],
            ],
        ],

        'constants' => [
            'L5_SWAGGER_CONST_HOST' => env('L5_SWAGGER_CONST_HOST', 'http://my-default-host.com'),
        ],
    ],
];
