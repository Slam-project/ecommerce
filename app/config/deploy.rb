# Base config :
set     :application,   "Integration continue"
set     :domain,        "bolthorm.com"
set     :deploy_to,     "/var/www/ecommerce"
set     :app_path,      "app"
set     :user,          "deploy"

set     :use_sudo,      false
set     :interactive_mode, false
set     :keep_releases,  5

# apache config
set     :writable_dirs, [ cache_path ]
#set     :webserver_user,        "www-data"
set     :permission_method,     :acl
set     :use_set_permissions,   true



# Bitbucket config :
ssh_options[:config] = false
set     :scm,           :git
set     :repository,    "https://github.com/Slam-project/ecommerce.git"
set     :branch,        "feature/travis-test" # set master to check
set     :scm_verbose,   true
set     :deploy_via,    :copy



# symfony config
set :shared_files,    [ app_path + "/config/parameters.yml", web_path + "/.htaccess" ]
set :shared_children, [ log_path, web_path + "/uploads", web_path + "/media", web_path + "/images" ]

set :use_composer,               true
set :dump_assetic_assets,        true



set     :model_manager, "doctrine"
# Or: `propel`

role    :web,           domain                         # Your HTTP server, Apache/etc
role    :app,           domain, :primary => true       # This may be the same as your `Web` server


# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL

before "symfony:assetic:dump", "symfony:assets:update_version"
after "deploy", "deploy:cleanup"
after "deploy", "symfony:clear_apc"
after "deploy:rollback:cleanup", "symfony:clear_apc"
