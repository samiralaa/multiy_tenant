<?php

namespace App\Listeners;

use App\Events\StoreCreated;
use DirectoryIterator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CreateStoreDatabase
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
 
     public function handle(StoreCreated $event): void
     {
         $store = $event->store;
         $dbName = "tenant_store_{$store->id}";
     
         try {
             // Update store's database configuration
             $store->database_config = [
                 'dbname' => $dbName,
             ];
             $store->save();
     
             // Create new tenant database if it doesn't exist
             DB::statement("CREATE DATABASE IF NOT EXISTS `$dbName`");
     
             // Switch to tenant database connection dynamically
             Config::set('database.connections.tenant.database', $dbName);
     
             // Run migrations for tenant-specific migrations directory
             $tenantMigrationsPath = database_path('migrations/tenants');
     
             if (!file_exists($tenantMigrationsPath)) {
                 throw new \Exception("Tenant migrations directory not found: $tenantMigrationsPath");
             }
     
             $dir = new DirectoryIterator($tenantMigrationsPath);
     
             foreach ($dir as $file) {
                 if ($file->isFile() && $file->getExtension() === 'php') {
                     Artisan::call('migrate', [
                         '--path' => 'database/migrations/tenants/' . $file->getFilename(),
                         '--force' => true,
                         '--database' => 'tenant',
                     ]);
                 }
             }
         } catch (\Exception $e) {
             // Handle exceptions
             logger()->error("Error during tenant database setup: " . $e->getMessage());
             // Rollback or take appropriate action
             // For now, let's log and throw the exception
             throw $e;
         } finally {
             // Restore the default database connection if needed
             // Ensure to handle this part based on your application logic
         }
     }
}
