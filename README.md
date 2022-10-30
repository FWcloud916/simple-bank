# simple-bank
簡易存提款 API 系統

## Requirement
* PHP >= 8.1
* node >= 16

or use

- docker
- docker composer

## Documentation
1. [Auth API Document](docs/auth.md)
2. [Account API Documentation](docs/account.md)

## Installation
### Makefile (docker composer)
- 建立環境:
```bash
make build-local
```

- develop in watch mode:
```bash
make run-watch
```

- build pages in dev:
```bash
make run-dev
```

- install js packages: ( or just run `npm install`)
```bash
make npm-install
```

- 更新 database:
```bash
make run-migrate
```

- 清除 docker
```bash
make stop-dev
```
