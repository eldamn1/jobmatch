<!DOCTYPE html>
<html>
<head>
    <title>JobMatch | Sign In</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: radial-gradient(circle at top left, #1a2940 0%, #0c1421 60%, #070d16 100%);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 420px;
            background: #ffffff;
            padding: 42px 36px 36px;
            border-radius: 10px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.45);
            border-top: 4px solid #c9a227;
        }

        .brand-mark {
            text-align: center;
            margin-bottom: 8px;
        }

        .brand-mark i {
            color: #c9a227;
            font-size: 1.6rem;
        }

        .brand-logo {
            height: 120px;
            width: auto;
            object-fit: contain;
        }

        .login-box h3 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #0f1b2d;
            text-align: center;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .login-box .subtitle {
            text-align: center;
            color: #9a9486;
            font-size: 0.8rem;
            margin-bottom: 30px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .form-label {
            font-size: 0.78rem;
            font-weight: 600;
            color: #4a4438;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            border: 1px solid #ddd8cd;
            padding: 5px 10px;
            border-radius: 6px;
        }

        .form-control:focus {
            border-color: #c9a227;
            box-shadow: 0 0 0 3px rgba(201,162,39,0.15);
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #1a2940, #0f1b2d);
            color: #e0c468;
            border: none;
            padding: 10px;
            font-weight: 600;
            border-radius: 6px;
            transition: 0.25s;
            margin-top: 8px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #0f1b2d, #060c14);
            color: #f3d98a;
        }

        .register-link {
            text-align: center;
            margin-top:14px;
            color: #6b6456;
        }

        .register-link a {
            color: #0f1b2d;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            color: #c9a227;
        }
    </style>
</head>

<body>

<div class="login-box">

    <div class="brand-mark">
        <img src="<?= $this->Url->image('logo.png') ?>" alt="JobMatch Logo" class="brand-logo">
    </div>
    <h3>Log In</h3>

    <?= $this->Flash->render() ?>

    <?= $this->Form->create() ?>

    <div class="mb-3">
        <?= $this->Form->control('email', [
            'class' => 'form-control',
            'label' => ['text' => 'Email', 'class' => 'form-label'],
        ]) ?>
    </div>

    <div class="mb-3">
        <?= $this->Form->control('password', [
            'type' => 'password',
            'class' => 'form-control',
            'label' => ['text' => 'Password', 'class' => 'form-label'],
        ]) ?>
    </div>

    <button class="btn-login" type="submit">Log In</button>

    <?= $this->Form->end() ?>

    <div class="register-link">
        Don't have account? <?= $this->Html->link('Sign Up', ['controller' => 'Users', 'action' => 'register']) ?>
    </div>

</div>

</body>
</html>