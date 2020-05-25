#!/bin/bash
psql -v ON_ERROR_STOP=1 -U postgres app < ./docker-entrypoint-initdb.d/database.sql