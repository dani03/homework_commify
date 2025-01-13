ENV_FILE = .env
ENV_EXAMPLE_FILE = .env.example
DATABASE_SQLITE = ./database/database.sqlite

build:
	composer install
	npm install
	@make "env-file"
	@make "sqlite-create-file"
	php artisan key:generate
	@make "migrate-seed"
	php artisan serve


# creation du fichier .env s'il n'existe pas en ajoutant les configuration de BDD
env-file:
	@if [ ! -f $(ENV_FILE) ]; then \
		cp $(ENV_EXAMPLE_FILE) $(ENV_FILE); \
		echo "$(ENV_FILE) a été créer."; \
	else \
		echo "$(ENV_FILE) existe déjà."; \
	fi

# création du fichier database.sqlite
sqlite-create-file:
	@if [ ! -f $(DATABASE_SQLITE) ]; then \
		touch $(DATABASE_SQLITE); \
		echo "$(DATABASE_SQLITE) est bien crée ..."; \
	else \
		echo "$(DATABASE_SQLITE) existe ..."; \
	fi


# migration
migrate-seed:
	php artisan migrate:refresh --seed
