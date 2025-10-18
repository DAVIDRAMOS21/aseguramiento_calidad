<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Inventario Inmuebles</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .user-info {
            background: rgba(255,255,255,0.1);
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 5px;
        }
        .stat-label {
            color: #666;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .quick-actions {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .quick-actions h2 {
            margin-top: 0;
            color: #333;
            font-size: 20px;
        }
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        .action-btn {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.3s ease;
            font-weight: 500;
        }
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .navigation {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .navigation h2 {
            margin-top: 0;
            color: #333;
            font-size: 20px;
        }
        .nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .nav-list li {
            margin-bottom: 10px;
        }
        .nav-list a {
            color: #667eea;
            text-decoration: none;
            padding: 8px 12px;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .nav-list a:hover {
            background-color: #f8f9ff;
        }
        .logout-section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Dashboard - Sistema de Inventario de Inmuebles</h1>
        <div class="user-info">
            <strong>{{ auth()->user()->name ?? auth()->user()->usuario ?? 'Usuario' }}</strong>
            | ID: {{ auth()->id() ?? 'N/A' }}
            @if(auth()->user() && auth()->user()->is_superuser)
                | <span style="background: rgba(255,215,0,0.3); padding: 2px 8px; border-radius: 3px;">Superusuario</span>
            @endif
        </div>
    </div>

    @if (session('status'))
        <div class="success">{{ session('status') }}</div>
    @endif

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Equipment::count() }}</div>
            <div class="stat-label">Total Equipos</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Equipment::where('estado', 'activo')->count() }}</div>
            <div class="stat-label">Equipos Activos</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Marca::count() }}</div>
            <div class="stat-label">Marcas Registradas</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Empleado::where('estado', 'activo')->count() }}</div>
            <div class="stat-label">Empleados Activos</div>
        </div>
    </div>

    <div class="quick-actions">
        <h2>Acciones Rápidas</h2>
        <div class="action-buttons">
            <a href="{{ route('equipment.register') }}" class="action-btn">Registrar Equipo</a>
            @if(auth()->user() && auth()->user()->is_superuser)
                <a href="{{ route('settings.user-registration') }}" class="action-btn">Registrar Usuario</a>
                <a href="{{ route('settings.user-roles') }}" class="action-btn">Gestionar Roles</a>
            @endif
        </div>
    </div>

    <div class="navigation">
        <h2>Configuración</h2>
        <ul class="nav-list">
            <li><a href="{{ route('settings.profile') }}">Mi Perfil</a></li>
            @if(auth()->user() && auth()->user()->is_superuser)
                <li><a href="{{ route('settings.user-registration') }}">Registro de Usuarios</a></li>
                <li><a href="{{ route('settings.user-roles') }}">Roles de Usuario</a></li>
            @endif
        </ul>
    </div>

    <div class="logout-section">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Cerrar Sesión</button>
        </form>
    </div>
</body>
</html>
