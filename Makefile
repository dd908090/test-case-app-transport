MAKEFLAGS += --silent

include .env
export UID = $(shell id -u)
export GID = $(shell id -g)
export USER_NAME = $(shell id -un)
export DOCKER_COMPOSE = docker-compose -f docker/docker-compose.yml

.PHONY: help build start stop shell logs

help:  ## Показать справку
	@echo "Доступные команды:"
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

build:  ## Собрать контейнер
	$(DOCKER_COMPOSE) build

start:  ## Запустить контейнер
	$(DOCKER_COMPOSE) up -d

stop:  ## Остановить контейнер
	$(DOCKER_COMPOSE) down

shell:  ## Войти в контейнер
	$(DOCKER_COMPOSE) exec app bash

logs:  ## Показать логи
	$(DOCKER_COMPOSE) logs -f app

.DEFAULT_GOAL := help