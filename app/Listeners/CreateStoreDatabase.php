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
use Illuminate\Support\Facades\Log;

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
             // Create new tenant database if it doesn't exist
             DB::statement("CREATE DATABASE IF NOT EXISTS `$dbName`");
             Log::info("Database `$dbName` created or already exists.");
 
             // Update store's database configuration
             $store->database_config = [
                 'dbname' => $dbName,
             ];
             $store->save();
             Log::info("Database configuration saved for store ID: {$store->id}");
 
             // Switch to tenant database connection dynamically
             Config::set('database.connections.tenant.database', $dbName);
             DB::purge('tenant'); // Ensure the connection is refreshed
             Log::info("Switched to tenant database: `$dbName`.");
 
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
                     Log::info("Migration run: " . $file->getFilename());
                 }
             }
         } catch (\Exception $e) {
             // Log the exception and rollback if necessary
             Log::error("Error during tenant database setup: " . $e->getMessage());
             // Optionally, you could delete the database here if creation failed partially
             throw $e;
         } finally {
             // Restore the default database connection if needed
             // Ensure to handle this part based on your application logic
         }
     }
}
