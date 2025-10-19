# Laravel Clean DDD App - Essential Commands
# Docker Compose with Laravel Sail

# Default target
.PHONY: help
help: ## Show this help message
	@echo "Laravel Clean DDD App - Essential Commands"
	@echo "========================================="
	@echo ""
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

# Docker Container Management
.PHONY: up
up: ## Start the development environment
	docker-compose up -d

.PHONY: down
down: ## Stop the development environment
	docker-compose down

.PHONY: restart
restart: ## Restart the development environment
	docker-compose restart

.PHONY: logs
logs: ## Show container logs
	docker-compose logs -f

.PHONY: build
build: ## Build the containers
	docker-compose build

.PHONY: status
status: ## Show container status
	docker-compose ps

# Database Operations
.PHONY: migrate
migrate: ## Run database migrations
	docker-compose exec laravel.test php artisan migrate

.PHONY: migrate-fresh
migrate-fresh: ## Run fresh migrations with seeding
	docker-compose exec laravel.test php artisan migrate:fresh --seed

.PHONY: rollback
rollback: ## Rollback the last migration
	docker-compose exec laravel.test php artisan migrate:rollback

.PHONY: seed
seed: ## Run database seeders
	docker-compose exec laravel.test php artisan db:seed

# API Testing
.PHONY: api-test
api-test: ## Test API endpoints
	@echo "Testing API endpoints..."
	@echo "Health check:"
	curl -s http://localhost/api/health | jq .
	@echo ""
	@echo "User endpoint (requires user ID):"
	@echo "curl http://localhost/api/users/1"
