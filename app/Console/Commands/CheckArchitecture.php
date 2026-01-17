<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CheckArchitecture extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:check-architecture 
                            {--fix : Attempt to fix issues automatically}
                            {--detailed : Show detailed output}';

    /**
     * The console command description.
     */
    protected $description = 'Verifica la coerenza del progetto con ARCHITECTURE.md e genera report in TODO.md';

    /**
     * Architecture definition - the expected project structure
     */
    private array $architecture = [
        'models' => [
            'required' => ['User', 'Event', 'Product'],
            'optional' => ['Order', 'OrderItem', 'Cart', 'CartItem'],
        ],
        'controllers' => [
            'required' => ['Controller', 'HomeController', 'EventController', 'ProductController', 'PageController'],
            'optional' => ['CartController', 'OrderController', 'AdminController', 'AuthController'],
        ],
        'services' => [
            'required' => ['ProductService', 'EventService'],
            'optional' => ['CartService', 'OrderService', 'UserService'],
        ],
        'repositories' => [
            'required' => ['ProductRepository', 'EventRepository'],
            'optional' => ['OrderRepository', 'UserRepository'],
        ],
        'interfaces' => [
            'services' => ['ProductServiceInterface', 'EventServiceInterface'],
            'repositories' => ['ProductRepositoryInterface', 'EventRepositoryInterface'],
        ],
        'providers' => [
            'required' => ['AppServiceProvider', 'RepositoryServiceProvider', 'ViewServiceProvider'],
        ],
        'tables' => [
            'required' => ['users', 'events', 'products', 'event_product', 'cache', 'jobs'],
            'optional' => ['orders', 'order_items', 'carts', 'cart_items'],
        ],
        'views' => [
            'required' => [
                'home',
                'layouts/app',
                'layouts/partials/header',
                'layouts/partials/footer',
                'events/index',
                'events/show',
                'products/index',
                'products/show',
                'components/product-card',
            ],
            'optional' => [
                'cart/index',
                'auth/login',
                'admin/dashboard',
            ],
        ],
        'routes' => [
            'required' => ['/', '/eventi', '/prodotti', '/chi-siamo', '/contatti'],
            'optional' => ['/carrello', '/checkout', '/account', '/admin'],
        ],
    ];

    /**
     * Issues found during check
     */
    private array $issues = [];
    private array $warnings = [];
    private array $passed = [];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('');
        $this->info('╔══════════════════════════════════════════════════════════════╗');
        $this->info('║        🏗️  ARCHITECTURE CHECK - Gioielli Artigianali        ║');
        $this->info('╚══════════════════════════════════════════════════════════════╝');
        $this->info('');

        // Run all checks
        $this->checkModels();
        $this->checkControllers();
        $this->checkServices();
        $this->checkRepositories();
        $this->checkProviders();
        $this->checkDatabaseTables();
        $this->checkViews();
        $this->checkRoutes();
        $this->checkEnvVariables();
        $this->checkServiceBindings();

        // Display results
        $this->displayResults();

        // Update TODO.md
        $this->updateTodoFile();

        return count($this->issues) > 0 ? Command::FAILURE : Command::SUCCESS;
    }

    /**
     * Check if all required Models exist
     */
    private function checkModels(): void
    {
        $this->info('📦 Checking Models...');
        $basePath = app_path('Models');

        foreach ($this->architecture['models']['required'] as $model) {
            $path = "{$basePath}/{$model}.php";
            if (File::exists($path)) {
                $this->passed[] = "Model {$model} exists";
                if ($this->option('detailed')) {
                    $this->line("  ✅ {$model}");
                }
            } else {
                $this->issues[] = [
                    'type' => 'MODEL',
                    'code' => 'MODEL-' . strtoupper(Str::slug($model, '')),
                    'message' => "Model {$model} non trovato",
                    'file' => $path,
                    'priority' => 'high',
                ];
                $this->error("  ❌ {$model} - MISSING");
            }
        }

        // Check optional models
        foreach ($this->architecture['models']['optional'] as $model) {
            $path = "{$basePath}/{$model}.php";
            if (!File::exists($path)) {
                $this->warnings[] = "Model opzionale {$model} non implementato";
                if ($this->option('detailed')) {
                    $this->warn("  ⚠️  {$model} - Optional, not implemented");
                }
            }
        }
    }

    /**
     * Check if all required Controllers exist
     */
    private function checkControllers(): void
    {
        $this->info('🎮 Checking Controllers...');
        $basePath = app_path('Http/Controllers');

        foreach ($this->architecture['controllers']['required'] as $controller) {
            $path = "{$basePath}/{$controller}.php";
            if (File::exists($path)) {
                $this->passed[] = "Controller {$controller} exists";
                
                // Verify it extends base Controller
                if ($controller !== 'Controller') {
                    $content = File::get($path);
                    if (!Str::contains($content, 'extends Controller')) {
                        $this->issues[] = [
                            'type' => 'CONTROLLER',
                            'code' => 'CTRL-EXTEND',
                            'message' => "{$controller} non estende Controller base",
                            'file' => $path,
                            'priority' => 'medium',
                        ];
                    }
                }
                
                if ($this->option('detailed')) {
                    $this->line("  ✅ {$controller}");
                }
            } else {
                $this->issues[] = [
                    'type' => 'CONTROLLER',
                    'code' => 'CTRL-' . strtoupper(Str::slug($controller, '')),
                    'message' => "Controller {$controller} non trovato",
                    'file' => $path,
                    'priority' => 'high',
                ];
                $this->error("  ❌ {$controller} - MISSING");
            }
        }
    }

    /**
     * Check Services and their interfaces
     */
    private function checkServices(): void
    {
        $this->info('⚙️  Checking Services...');
        $basePath = app_path('Services');
        $contractsPath = app_path('Services/Contracts');

        foreach ($this->architecture['services']['required'] as $service) {
            $path = "{$basePath}/{$service}.php";
            $interfacePath = "{$contractsPath}/{$service}Interface.php";

            // Check service exists
            if (File::exists($path)) {
                $this->passed[] = "Service {$service} exists";
                if ($this->option('detailed')) {
                    $this->line("  ✅ {$service}");
                }

                // Check it implements interface
                $content = File::get($path);
                if (!Str::contains($content, "implements {$service}Interface")) {
                    $this->issues[] = [
                        'type' => 'SERVICE',
                        'code' => 'SVC-IMPL',
                        'message' => "{$service} non implementa {$service}Interface",
                        'file' => $path,
                        'priority' => 'high',
                    ];
                }
            } else {
                $this->issues[] = [
                    'type' => 'SERVICE',
                    'code' => 'SVC-' . strtoupper(Str::slug($service, '')),
                    'message' => "Service {$service} non trovato",
                    'file' => $path,
                    'priority' => 'high',
                ];
                $this->error("  ❌ {$service} - MISSING");
            }

            // Check interface exists
            if (!File::exists($interfacePath)) {
                $this->issues[] = [
                    'type' => 'INTERFACE',
                    'code' => 'INT-' . strtoupper(Str::slug($service, '')),
                    'message' => "Interface {$service}Interface non trovata",
                    'file' => $interfacePath,
                    'priority' => 'high',
                ];
            }
        }
    }

    /**
     * Check Repositories and their interfaces
     */
    private function checkRepositories(): void
    {
        $this->info('🗄️  Checking Repositories...');
        $basePath = app_path('Repositories');
        $contractsPath = app_path('Repositories/Contracts');

        foreach ($this->architecture['repositories']['required'] as $repo) {
            $path = "{$basePath}/{$repo}.php";
            $interfacePath = "{$contractsPath}/{$repo}Interface.php";

            if (File::exists($path)) {
                $this->passed[] = "Repository {$repo} exists";
                if ($this->option('detailed')) {
                    $this->line("  ✅ {$repo}");
                }
            } else {
                $this->issues[] = [
                    'type' => 'REPOSITORY',
                    'code' => 'REPO-' . strtoupper(Str::slug($repo, '')),
                    'message' => "Repository {$repo} non trovato",
                    'file' => $path,
                    'priority' => 'high',
                ];
                $this->error("  ❌ {$repo} - MISSING");
            }

            if (!File::exists($interfacePath)) {
                $this->issues[] = [
                    'type' => 'INTERFACE',
                    'code' => 'INT-' . strtoupper(Str::slug($repo, '')),
                    'message' => "Interface {$repo}Interface non trovata",
                    'file' => $interfacePath,
                    'priority' => 'high',
                ];
            }
        }
    }

    /**
     * Check Service Providers
     */
    private function checkProviders(): void
    {
        $this->info('🔌 Checking Providers...');
        $basePath = app_path('Providers');

        foreach ($this->architecture['providers']['required'] as $provider) {
            $path = "{$basePath}/{$provider}.php";
            if (File::exists($path)) {
                $this->passed[] = "Provider {$provider} exists";
                if ($this->option('detailed')) {
                    $this->line("  ✅ {$provider}");
                }
            } else {
                $this->issues[] = [
                    'type' => 'PROVIDER',
                    'code' => 'PROV-' . strtoupper(Str::slug($provider, '')),
                    'message' => "Provider {$provider} non trovato",
                    'file' => $path,
                    'priority' => 'high',
                ];
                $this->error("  ❌ {$provider} - MISSING");
            }
        }

        // Check providers are registered
        $providersFile = base_path('bootstrap/providers.php');
        if (File::exists($providersFile)) {
            $content = File::get($providersFile);
            foreach ($this->architecture['providers']['required'] as $provider) {
                if (!Str::contains($content, $provider)) {
                    $this->issues[] = [
                        'type' => 'CONFIG',
                        'code' => 'CFG-PROV',
                        'message' => "{$provider} non registrato in bootstrap/providers.php",
                        'file' => $providersFile,
                        'priority' => 'high',
                    ];
                }
            }
        }
    }

    /**
     * Check database tables exist
     */
    private function checkDatabaseTables(): void
    {
        $this->info('🗃️  Checking Database Tables...');

        foreach ($this->architecture['tables']['required'] as $table) {
            if (Schema::hasTable($table)) {
                $this->passed[] = "Table {$table} exists";
                if ($this->option('detailed')) {
                    $this->line("  ✅ {$table}");
                }
            } else {
                $this->issues[] = [
                    'type' => 'DATABASE',
                    'code' => 'DB-' . strtoupper(Str::slug($table, '')),
                    'message' => "Tabella {$table} non trovata nel database",
                    'file' => 'database/migrations/',
                    'priority' => 'high',
                ];
                $this->error("  ❌ {$table} - MISSING");
            }
        }

        // Check optional tables
        foreach ($this->architecture['tables']['optional'] as $table) {
            if (!Schema::hasTable($table)) {
                $this->warnings[] = "Tabella opzionale {$table} non creata";
            }
        }
    }

    /**
     * Check Blade views exist
     */
    private function checkViews(): void
    {
        $this->info('🖼️  Checking Views...');
        $basePath = resource_path('views');

        foreach ($this->architecture['views']['required'] as $view) {
            $path = "{$basePath}/{$view}.blade.php";
            if (File::exists($path)) {
                $this->passed[] = "View {$view} exists";
                if ($this->option('detailed')) {
                    $this->line("  ✅ {$view}");
                }
            } else {
                $this->issues[] = [
                    'type' => 'VIEW',
                    'code' => 'VIEW-' . strtoupper(Str::slug($view, '')),
                    'message' => "Vista {$view}.blade.php non trovata",
                    'file' => $path,
                    'priority' => 'medium',
                ];
                $this->error("  ❌ {$view} - MISSING");
            }
        }
    }

    /**
     * Check routes are defined
     */
    private function checkRoutes(): void
    {
        $this->info('🛤️  Checking Routes...');
        $routesFile = base_path('routes/web.php');
        
        if (!File::exists($routesFile)) {
            $this->issues[] = [
                'type' => 'ROUTE',
                'code' => 'ROUTE-FILE',
                'message' => 'File routes/web.php non trovato',
                'file' => $routesFile,
                'priority' => 'high',
            ];
            return;
        }

        $content = File::get($routesFile);

        foreach ($this->architecture['routes']['required'] as $route) {
            // Improved check - look for route pattern or prefix in file
            $routeName = ltrim($route, '/');
            $pattern = $route === '/' ? "Route::get('/'," : $routeName;
            
            // Check for exact route, prefix, or quoted route
            $found = Str::contains($content, "'{$route}'") 
                  || Str::contains($content, "\"{$route}\"")
                  || Str::contains($content, "prefix('{$routeName}')")
                  || Str::contains($content, "'{$routeName}'")
                  || ($route === '/' && Str::contains($content, "Route::get('/',"));
            
            if ($found) {
                $this->passed[] = "Route {$route} defined";
                if ($this->option('detailed')) {
                    $this->line("  ✅ {$route}");
                }
            } else {
                $this->issues[] = [
                    'type' => 'ROUTE',
                    'code' => 'ROUTE-' . strtoupper(Str::slug($route, '')),
                    'message' => "Route {$route} non definita",
                    'file' => $routesFile,
                    'priority' => 'medium',
                ];
                $this->error("  ❌ {$route} - MISSING");
            }
        }
    }

    /**
     * Check required environment variables
     */
    private function checkEnvVariables(): void
    {
        $this->info('🔐 Checking Environment...');
        
        $required = [
            'APP_NAME',
            'APP_KEY',
            'DB_CONNECTION',
            'DB_HOST',
            'DB_DATABASE',
            'DB_USERNAME',
        ];

        foreach ($required as $var) {
            if (env($var)) {
                $this->passed[] = "ENV {$var} set";
                if ($this->option('detailed')) {
                    $this->line("  ✅ {$var}");
                }
            } else {
                $this->issues[] = [
                    'type' => 'ENV',
                    'code' => 'ENV-' . strtoupper(Str::slug($var, '')),
                    'message' => "Variabile {$var} non configurata in .env",
                    'file' => '.env',
                    'priority' => 'high',
                ];
                $this->error("  ❌ {$var} - NOT SET");
            }
        }
    }

    /**
     * Check DI bindings in RepositoryServiceProvider
     */
    private function checkServiceBindings(): void
    {
        $this->info('🔗 Checking Service Bindings...');
        $providerPath = app_path('Providers/RepositoryServiceProvider.php');

        if (!File::exists($providerPath)) {
            return; // Already reported in checkProviders
        }

        $content = File::get($providerPath);
        $bindings = [
            'ProductRepositoryInterface' => 'ProductRepository',
            'EventRepositoryInterface' => 'EventRepository',
            'ProductServiceInterface' => 'ProductService',
            'EventServiceInterface' => 'EventService',
        ];

        foreach ($bindings as $interface => $implementation) {
            if (Str::contains($content, $interface) && Str::contains($content, $implementation)) {
                $this->passed[] = "Binding {$interface} → {$implementation}";
                if ($this->option('detailed')) {
                    $this->line("  ✅ {$interface} → {$implementation}");
                }
            } else {
                $this->issues[] = [
                    'type' => 'BINDING',
                    'code' => 'BIND-' . strtoupper(Str::slug($interface, '')),
                    'message' => "Binding mancante: {$interface} → {$implementation}",
                    'file' => $providerPath,
                    'priority' => 'high',
                ];
            }
        }
    }

    /**
     * Display results summary
     */
    private function displayResults(): void
    {
        $this->info('');
        $this->info('═══════════════════════════════════════════════════════════════');
        $this->info('                         📊 RESULTS                            ');
        $this->info('═══════════════════════════════════════════════════════════════');
        
        $this->info('');
        $this->line("  ✅ Passed:   " . count($this->passed));
        $this->line("  ⚠️  Warnings: " . count($this->warnings));
        $this->line("  ❌ Issues:   " . count($this->issues));
        $this->info('');

        if (count($this->issues) === 0) {
            $this->info('  🎉 Architettura OK! Nessun problema trovato.');
        } else {
            $this->error('  ⚠️  Trovati ' . count($this->issues) . ' problemi da risolvere.');
            $this->info('  Vedi TODO.md per i dettagli.');
        }
        $this->info('');
    }

    /**
     * Update TODO.md with found issues
     */
    private function updateTodoFile(): void
    {
        $todoPath = base_path('TODO.md');
        
        if (!File::exists($todoPath)) {
            $this->warn('TODO.md non trovato, lo creo...');
        }

        $content = File::exists($todoPath) ? File::get($todoPath) : '';

        // Generate issues report
        $report = "\n\n---\n\n## 🤖 Report Automatico (" . now()->format('Y-m-d H:i') . ")\n\n";
        $report .= "> Generato da `php artisan app:check-architecture`\n\n";

        if (count($this->issues) > 0) {
            $report .= "### ❌ Problemi Trovati\n\n";
            
            $grouped = collect($this->issues)->groupBy('type');
            
            foreach ($grouped as $type => $typeIssues) {
                $report .= "#### {$type}\n\n";
                foreach ($typeIssues as $issue) {
                    $report .= "- [ ] **{$issue['code']}**: {$issue['message']}\n";
                    $report .= "  - File: `{$issue['file']}`\n";
                    $report .= "  - Priorità: {$issue['priority']}\n";
                }
                $report .= "\n";
            }
        } else {
            $report .= "### ✅ Nessun Problema\n\n";
            $report .= "L'architettura del progetto è coerente con ARCHITECTURE.md\n";
        }

        if (count($this->warnings) > 0) {
            $report .= "### ⚠️ Warnings (Opzionali)\n\n";
            foreach ($this->warnings as $warning) {
                $report .= "- {$warning}\n";
            }
        }

        $report .= "\n### 📈 Statistiche\n\n";
        $report .= "| Metrica | Valore |\n";
        $report .= "|---------|--------|\n";
        $report .= "| Check passati | " . count($this->passed) . " |\n";
        $report .= "| Warnings | " . count($this->warnings) . " |\n";
        $report .= "| Errori | " . count($this->issues) . " |\n";

        // Remove old report section if exists
        $content = preg_replace('/\n\n---\n\n## 🤖 Report Automatico.*$/s', '', $content);

        // Append new report
        $content .= $report;

        File::put($todoPath, $content);
        $this->info("📝 TODO.md aggiornato con il report.");
    }
}
