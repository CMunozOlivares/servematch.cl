<?php
// seleccionar_club.php
require_once 'admin_v2/includes/db_connect.php'; // Ajusta la ruta a tu conexión

try {
    $stmt = $pdo->query("SELECT id, nombre, slug, logo FROM clubes WHERE estado = 'Activo' ORDER BY nombre ASC");
    $clubes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    die("Error al cargar los clubes.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecciona tu Club - ServeMatch</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; background-color: #f8fafc; margin: 0; padding: 40px 20px; color: #1e293b; text-align: center; }
        .logo-main { max-width: 150px; margin-bottom: 20px; }
        h1 { color: #0f172a; margin-bottom: 10px; font-size: 24px; }
        p { color: #64748b; margin-bottom: 40px; }
        
        .grid-clubes { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; max-width: 900px; margin: 0 auto; }
        
        .club-card { background: white; border-radius: 16px; padding: 25px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: 1px solid #e2e8f0; text-decoration: none; color: inherit; transition: 0.3s; display: flex; flex-direction: column; align-items: center; gap: 15px; }
        .club-card:hover { transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.08); border-color: #38bdf8; }
        
        .club-logo { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 2px solid #f1f5f9; background: #fff; }
        .club-name { font-weight: 800; font-size: 16px; color: #0f172a; margin: 0; }
        .btn-entrar { background: #0ea5e9; color: white; padding: 8px 20px; border-radius: 20px; font-size: 13px; font-weight: bold; width: 100%; box-sizing: border-box; }
    </style>
</head>
<body>

    <img src="img/ss.png" alt="ServeMatch" class="logo-main" onerror="this.src='https://via.placeholder.com/150x50?text=ServeMatch'">
    <h1>Encuentra tu Club</h1>
    <p>Selecciona el recinto donde juegas para iniciar sesión o registrarte.</p>

    <div class="grid-clubes">
        <?php foreach ($clubes as $club): 
            $logo_url = !empty($club['logo']) ? 'uploads/logos/' . $club['logo'] : 'img/logo.png';
        ?>
            <a href="acceso.php?club=<?= urlencode($club['slug']) ?>" class="club-card">
                <img src="<?= $logo_url ?>" alt="<?= htmlspecialchars($club['nombre']) ?>" class="club-logo" onerror="this.src='img/logo.png'">
                <h3 class="club-name"><?= htmlspecialchars($club['nombre']) ?></h3>
                <div class="btn-entrar">Ingresar al Club</div>
            </a>
        <?php endforeach; ?>
    </div>

</body>
</html>
