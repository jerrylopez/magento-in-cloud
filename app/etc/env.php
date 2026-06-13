<?php
return [
    'cache' => [
        'frontend' => [
            'default' => [
                'frontend_options' => [
                    'write_control' => false
                ],
                'id_prefix' => '69d_',
                'backend' => 'redis',
                'backend_options' => [
                    'server' => $_ENV['REDIS_HOST'],
                    'database' => '0',
                    'port' => $_ENV['REDIS_PORT'],
                    'password' => $_ENV['REDIS_PASSWORD'],
                    'compress_data' => '1',
                    'compression_lib' => '',
                    'serializer' => 'igbinary',
                    'use_lua' => '0',
                    'use_lua_on_gc' => '1'
                ]
            ],
            'page_cache' => [
                'frontend_options' => [
                    'write_control' => false
                ],
                'id_prefix' => '69d_',
                'backend' => 'redis',
                'backend_options' => [
                    'server' => $_ENV['REDIS_HOST'],
                    'database' => '1',
                    'port' => $_ENV['REDIS_PORT'],
                    'password' => $_ENV['REDIS_PASSWORD'],
                    'compress_data' => '0',
                    'compression_lib' => '',
                    'serializer' => 'igbinary'
                ]
            ]
        ],
        'graphql' => [
            'id_salt' => 'XcaDeQKHwc8QjrAt1e7jjJS4yCpnrLMs'
        ],
        'allow_parallel_generation' => false
    ],
    'MAGE_MODE' => $_ENV['MAGE_MODE'],
    'system' => [
        'default' => [
            'design' => [
                'head' => [
                    'demonotice' => '1'
                ],
                'footer' => [
                    'absolute_footer' => '<script src="/livereload.js?port=443"></script>'
                ]
            ],
            'web' => [
                'secure' => [
                    'offloader_header' => 'X-Forwarded-Proto',
                    'use_in_frontend' => '1',
                    'use_in_adminhtml' => '1',
                    'base_url' => $_ENV['APP_URL'] . '/'
                ],
                'seo' => [
                    'use_rewrites' => '1'
                ],
                'url' => [
                    'use_store' => '0',
                    'redirect_to_base' => '1'
                ],
                'cookie' => [
                    'cookie_path' => null,
                    'cookie_httponly' => '1',
                    'cookie_restriction' => '0'
                ],
                'session' => [
                    'use_remote_addr' => '0',
                    'use_http_via' => '0',
                    'use_http_x_forwarded_for' => '0',
                    'use_http_user_agent' => '0',
                    'use_frontend_sid' => '1'
                ],
                'browser_capabilities' => [
                    'cookies' => '1',
                    'javascript' => '1',
                    'local_storage' => '0'
                ],
                'unsecure' => [
                    'base_url' => $_ENV['APP_URL'] . '/'
                ]
            ],
            'catalog' => [
                'frontend' => [
                    'list_allow_all' => '0',
                    'flat_catalog_category' => '0',
                    'flat_catalog_product' => '0'
                ],
            ],
            'system' => [
                'full_page_cache' => [
                    'caching_application' => '1',
                    'ttl' => '604800'
                ]
            ],
            'dev' => [
                'front_end_development_workflow' => [
                    'type' => 'server_side_compilation'
                ],
                'template' => [
                    'allow_symlink' => '0',
                    'minify_html' => '0'
                ],
                'js' => [
                    'merge_files' => '0',
                    'enable_js_bundling' => '0',
                    'minify_files' => '0',
                    'translate_strategy' => 'dictionary',
                    'session_storage_logging' => '0',
                    'session_storage_key' => 'collected_errors'
                ],
                'css' => [
                    'merge_css_files' => '0',
                    'minify_files' => '0'
                ],
                'image' => [
                    'default_adapter' => 'GD2'
                ],
                'static' => [
                    'sign' => '0'
                ]
            ],
            'admin' => [
                'url' => [
                    'use_custom' => '0',
                    'use_custom_path' => '0'
                ],
                'security' => [
                    'use_form_key' => '1',
                    'use_case_sensitive_login' => '0',
                    'session_lifetime' => '7200',
                    'lockout_failures' => '6',
                    'lockout_threshold' => '30',
                    'password_lifetime' => '90',
                    'password_is_forced' => '1'
                ]
            ]
        ]
    ],
    'backend' => [
        'frontName' => $_ENV['BACKEND_NAME']
    ],
    'remote_storage' => [
        'driver' => 'file'
    ],
    'config' => [
        'async' => 0
    ],
    'queue' => [
        'consumers_wait_for_messages' => 1
    ],
    'crypt' => [
        'key' => $_ENV['CRYPT_KEY']
    ],
    'db' => [
        'table_prefix' => '',
        'connection' => [
            'default' => [
                'host' => $_ENV['DB_PORT'] ? $_ENV['DB_HOST'].':'.$_ENV['DB_PORT'] : $_ENV['DB_HOST'],
                'dbname' => $_ENV['DB_DATABASE'],
                'username' => $_ENV['DB_USERNAME'],
                'password' => $_ENV['DB_PASSWORD'],
                'model' => 'mysql4',
                'engine' => 'innodb',
                'active' => '1',
                'driver_options' => [
                    1014 => false
                ]
            ]
        ]
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'session' => [
        'save' => 'redis',
        'redis' => [
            'host' => $_ENV['REDIS_HOST'],
            'port' => $_ENV['REDIS_PORT'],
            'password' => $_ENV['REDIS_PASSWORD'],
            'timeout' => '2.5',
            'retries' => '0',
            'persistent_identifier' => '',
            'database' => '2',
            'compression_threshold' => '2048',
            'compression_library' => 'gzip',
            'log_level' => '1',
            'max_concurrency' => '20',
            'break_after_frontend' => '5',
            'break_after_adminhtml' => '30',
            'first_lifetime' => '600',
            'bot_first_lifetime' => '60',
            'bot_lifetime' => '7200',
            'disable_locking' => '0',
            'min_lifetime' => '60',
            'max_lifetime' => '2592000',
            'sentinel_master' => '',
            'sentinel_servers' => '',
            'sentinel_connect_retries' => '5',
            'sentinel_verify_master' => '0'
        ]
    ],
    'lock' => [
        'provider' => 'db'
    ],
    'directories' => [
        'document_root_is_pub' => true
    ],
    'cache_types' => [
        'config' => 1,
        'layout' => 1,
        'block_html' => 1,
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'compiled_config' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'graphql_query_resolver_result' => 1,
        'full_page' => 1,
        'config_webservice' => 1,
        'translate' => 1
    ],
    'downloadable_domains' => [
        'localhost'
    ],
    'install' => [
        'date' => 'Sat, 13 Jun 2026 19:43:25 +0000'
    ]
];
