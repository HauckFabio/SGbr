#!/bin/bash

# Criar banco de dados
psql -U postgres -c "CREATE DATABASE placessystem;"

# Executar migrações ou comandos adicionais
# php artisan migrate

# Outras configurações ou comandos que você precisa executar na inicialização do contêiner

exit 0