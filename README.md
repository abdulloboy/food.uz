<p align="center">
    <h1 align="center">Food module with ingredients</h1>
    <br>
</p>

1. Copy the modules/food/ directory to your application.

2. Include the food module and add it to application configuration.
```php
'modules' => [
        'food' => [
            'class' => 'app\modules\food\Module',
        ],
    ],
```

3. Run the migrations in the food module by adding namespace to config/console.php

```php
'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => null, 
            'migrationNamespaces' => [
                'app\migrations', 
                'app\modules\food\migrations', 
            ],
        ],
    ],
```

4. Inglude module asset in your application asset.

```php
public $depends = [
        'app\modules\food\assets\ModuleAsset',
    ];
```

