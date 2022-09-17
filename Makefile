start-db:
	php artisan make:model Article -fm
	php artisan make:model Tag -fm
	php artisan make:model Comment -fm
	php artisan make:model State -fm

	# php artisan make:migration create_articles_table
	# php artisan make:migration create_tags_table
	# php artisan make:migration create_comments_table
	# php artisan make:migration create_states_table

	# php artisan make:factory ArticleFactory --model=Article
	# php artisan make:factory TagFactory --model=Tag
	# php artisan make:factory CommentFactory --model=Comment
	# php artisan make:factory StateFactory --model=State
create-seed-db:
	php artisan db:wipe
	php artisan migrate
	php artisan db:seed
refresh-seed-db:
	php artisan migrate:refresh --seed
