<?= helper('page') ?>
<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/x-icon" href="<?= get_site_icon_url('ico') ?>" />
    <link rel="apple-touch-icon" href="<?= get_site_icon_url('180') ?>">
    <link rel="manifest" href="<?= route_to('webmanifest') ?>">
    <meta name="theme-color" content="<?= \App\Controllers\WebmanifestController::THEME_COLORS[service('settings')->get('App.theme')]['theme'] ?>">
    <script async src="https://u.leftarchive.ie/script.js" data-website-id="ec574407-6b92-4abe-9c64-b95baaf212b2"></script>
    <script>
    // Check that service workers are supported
    if ('serviceWorker' in navigator) {
        // Use the window load event to keep the page load performant
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js');
        });
    }
    </script>

    <?= $metatags ?>

    <link rel='stylesheet' type='text/css' href='<?= route_to('themes-colors-css') ?>' />
    <?= service('vite')
        ->asset('styles/index.css', 'css') ?>
    <?= service('vite')
        ->asset('js/app.ts', 'js') ?>
    <?= service('vite')
        ->asset('js/audio-player.ts', 'js') ?>
</head>

<body class="flex flex-col min-h-screen mx-auto bg-base theme-<?= service('settings')
        ->get('App.theme') ?>">
    <?php if (auth()->loggedIn()): ?>
        <?= $this->include('_admin_navbar') ?>
    <?php endif; ?>

    <header class="py-8 border-b bg-elevated border-subtle">
        <div class="container flex flex-col items-start px-2 py-4 mx-auto">
            <a href="<?= route_to('home') ?>"
            class="inline-flex items-center mb-2 text-sm focus:ring-accent"><?= icon(
                'arrow-left',
                'mr-2',
            ) . lang('Page.back_to_home') ?></a>
            <Heading tagName="h1" size="large"><?= esc($page->title) ?></Heading>
        </div>
    </header>
    <main class="container flex-1 px-4 py-6 mx-auto">
        <?= $this->renderSection('content') ?>
    </main>
    <footer class="container flex justify-between px-2 py-4 mx-auto text-sm text-right border-t border-subtle">
        <nav>
            <a href="<?= route_to('home') ?>" class="px-2 py-1 underline hover:no-underline focus:ring-accent">Home</a>
            <a href="<?= route_to('credits') ?>" class="px-2 py-1 underline hover:no-underline focus:ring-accent">Credits</a>
        </nav>
        <small><?= lang('Common.powered_by', [
                'castopod' =>
                    '<a class="underline hover:no-underline focus:ring-accent" href="https://castopod.org/" target="_blank" rel="noreferrer noopener">Castopod</a>',
            ], null, false) ?></small>
    </footer>
</body>
