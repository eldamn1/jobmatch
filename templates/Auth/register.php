<!DOCTYPE html>
<html>
<head>
    <title>JobMatch | Sign Up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            background: radial-gradient(circle at top left, #1a2940 0%, #0c1421 60%, #070d16 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 0;
        }

        .register-box {
            width: 440px;
            background: #ffffff;
            padding: 40px 36px 32px;
            border-radius: 10px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.45);
            border-top: 4px solid #c9a227;
        }

        .brand-mark { text-align: center; margin-bottom: 4px; }
        .brand-logo { height: 110px; width: auto; object-fit: contain; }

        .register-box h3 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #0f1b2d;
            text-align: center;
            letter-spacing: 0.5px;
            margin-bottom: 22px;
        }

        .form-label {
            font-size: 0.76rem;
            font-weight: 600;
            color: #4a4438;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .form-control {
            border: 1px solid #ddd8cd;
            padding: 9px 12px;
            border-radius: 6px;
            width: 100%;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #c9a227;
            box-shadow: 0 0 0 3px rgba(201,162,39,0.15);
            outline: none;
        }

        .form-control.is-invalid { border-color: #c0392b; }

        .error-message { color: #c0392b; font-size: 0.78rem; margin-top: 4px; }

        .field-hint {
            font-size: 0.74rem;
            color: #8a8478;
            margin-top: 5px;
            line-height: 1.4;
        }
        .field-hint i { color: #c9a227; }

        .btn-register {
            width: 100%;
            background: linear-gradient(135deg, #1a2940, #0f1b2d);
            color: #e0c468;
            border: none;
            padding: 11px;
            font-weight: 600;
            border-radius: 6px;
            transition: 0.25s;
            margin-top: 10px;
            cursor: pointer;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #0f1b2d, #060c14);
            color: #f3d98a;
        }

        .login-link { text-align: center; margin-top: 14px; color: #6b6456; font-size: 0.9rem; }
        .login-link a { color: #0f1b2d; text-decoration: none; font-weight: 600; }
        .login-link a:hover { color: #c9a227; }
    </style>
</head>

<body>

<div class="register-box">

    <?= $this->Flash->render() ?>

    <div class="brand-mark">
        <img src="<?= $this->Url->image('logo.png') ?>" alt="JobMatch Logo" class="brand-logo">
    </div>
    <h3>Sign Up</h3>

    <?= $this->Form->create($user) ?>

    <div class="mb-3">
        <?= $this->Form->control('fullname', [
            'class' => 'form-control',
            'label' => ['text' => 'Full Name', 'class' => 'form-label'],
            'required' => true,
            'templates' => [
                'error' => '<div class="error-message">{{content}}</div>',
            ],
        ]) ?>
    </div>

    <div class="mb-3">
        <?= $this->Form->control('email', [
            'class' => 'form-control',
            'label' => ['text' => 'Email', 'class' => 'form-label'],
            'required' => true,
            'templates' => [
                'error' => '<div class="error-message">{{content}}</div>',
            ],
        ]) ?>

    <div class="mb-3">
        <?= $this->Form->control('password', [
            'type' => 'password',
            'class' => 'form-control',
            'label' => ['text' => 'Password', 'class' => 'form-label'],
            'required' => true,
            'templates' => [
                'error' => '<div class="error-message">{{content}}</div>',
            ],
        ]) ?>
        <div class="field-hint">
            <i class="fa-solid fa-shield-halved"></i>
            Min 8 characters with an uppercase, a lowercase, a number, and a symbol.
        </div>
    </div>

    <button class="btn-register" type="submit">
        <i class="fa-solid fa-user-plus"></i> Register
    </button>

    <?= $this->Form->end() ?>

    <div class="login-link">
        Already have account? <?= $this->Html->link('Log In', ['controller' => 'Users', 'action' => 'login']) ?>
    </div>

</div>

</body>
</html>