# 📚 Course Catalog Project

A full-stack web application to browse and manage a categorized course catalog. Built with:

- 🐘 PHP (PSR-12 compliant REST API)
- 🐳 Docker (with Traefik for local domain routing)
- 🌱 MySQL 8 (with seed data)
- ⚡ Vue 3 + Vite (SPA frontend)
- 🔗 Axios (for API requests)

---

## 🚀 Features

- Browse courses by category/subcategory
- Fully recursive category structure
- Real-time UI updates
- RESTful API with JSON responses
- Seeded data from local JSON files
- Clean component-based Vue structure

---

## 🏗️ Project Instructions

### 1. Clone the repo

```bash
1) git clone https://github.com/torika2/kc-fullstack-dev-tech-task.git
2) Download and Open Docker Desktop
3) docker-compose up --build
4) php api/index.php migrate
5) php api/index.php seed
```

```bash
http://front.cc.localhost:5173
```
