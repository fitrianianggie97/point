<?php

namespace App\Console\Commands;

use App\Model\Project\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class AlterTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:alter-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $projects = Project::all();
        foreach ($projects as $project) {
            $db = env('DB_DATABASE').'_'.strtolower($project->code);

            $this->line('Clone '.$project->code);
            Artisan::call('tenant:database:backup-clone', ['project_code' => strtolower($project->code)]);
            $this->line('Alter '.$project->code);
            config()->set('database.connections.tenant.database', $db);
            DB::connection('tenant')->reconnect();
//            DB::connection('tenant')->statement('ALTER TABLE `customers` DROP COLUMN `disabled`');
//            DB::connection('tenant')->statement('ALTER TABLE `customers` ADD COLUMN `archived_at` datetime default null');
//            DB::connection('tenant')->statement('ALTER TABLE `customers` ADD COLUMN `archived_by` integer(10) unsigned default null');
//            DB::connection('tenant')->statement('ALTER TABLE `customers` ADD CONSTRAINT `customers_archived_by_foreign` FOREIGN KEY (`archived_by`) REFERENCES users (`id`) ON DELETE RESTRICT');

            DB::statement('ALTER TABLE `cloud_storages` ADD COLUMN `feature_id` integer(10) unsigned default null after `feature`');
            DB::statement('ALTER TABLE `cloud_storages` ADD COLUMN `notes` text default null after `feature_id`');
            DB::statement('ALTER TABLE `cloud_storages` ADD COLUMN `is_user_protected` tinyint(1) not null default 1 after `owner_id`');
        }
    }
}
