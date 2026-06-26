<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Clinic CRM') ?></title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f2f5; margin: 0; }
        .navbar { background: #1a73e8; padding: 15px; color: white; }
        .navbar a { color: white; text-decoration: none; margin-right: 15px; font-weight: bold; }
        .container { max-width: 900px; margin: 30px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .alert-success { background: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 4px; }
        .alert-error { background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 4px; }
    </style>
</head>
<body>
    <?php partial('partials/nav'); ?>
    
    <div class="container">
        <?php partial('partials/flash'); ?>
        <?= $content ?? '' ?>
    </div>
</body>
</html>