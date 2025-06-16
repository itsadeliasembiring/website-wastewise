# Nama Project Laravel

Brief description tentang aplikasi Laravel Anda.

## Requirements

- PHP >= 8.1
- Composer
- MySQL/PostgreSQL
- Node.js & NPM (untuk frontend assets)

## Installation

1. **Clone repository**
   ```bash
   git clone https://github.com/username/project-name.git
   cd project-name
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   # Edit .env file dengan database credentials
   php artisan migrate
   php artisan db:seed  # jika ada seeder
   ```

5. **Build assets**
   ```bash
   npm run dev
   # atau untuk production
   npm run build
   ```

6. **Start development server**
   ```bash
   php artisan serve
   ```

## Configuration

### Database
Update `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=username
DB_PASSWORD=password
```

### Mail (Optional)
```env
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
```

## Usage

### Authentication
- Register: `POST /register`
- Login: `POST /login`
- Logout: `POST /logout`

### Main Features
- **Feature 1**: Deskripsi singkat
- **Feature 2**: Deskripsi singkat
- **Feature 3**: Deskripsi singkat

### API Endpoints (jika ada)
```
GET    /api/users          # Get all users
POST   /api/users          # Create user
GET    /api/users/{id}     # Get specific user
PUT    /api/users/{id}     # Update user
DELETE /api/users/{id}     # Delete user
```

## Development

### Running Tests
```bash
php artisan test
# atau
./vendor/bin/phpunit
```

### Code Style
```bash
# Install PHP CS Fixer
composer require --dev friendsofphp/php-cs-fixer

# Run formatter
./vendor/bin/php-cs-fixer fix
```

### Debugging
```bash
# Enable debug mode di .env
APP_DEBUG=true

# Clear cache saat development
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Deployment

### Production Setup
```bash
# Optimize untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

### Environment Variables
Pastikan set di production:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

## Contributing

1. Fork repository
2. Create feature branch: `git checkout -b feature-name`
3. Commit changes: `git commit -am 'Add feature'`
4. Push branch: `git push origin feature-name`
5. Submit Pull Request

## Troubleshooting

### Common Issues

**Storage Permission Error**
```bash
chmod -R 775 storage bootstrap/cache
```

**Migration Error**
```bash
php artisan migrate:fresh --seed
```

**Asset Not Loading**
```bash
npm run dev
php artisan storage:link
```

## License

This project is licensed under the MIT License - see [LICENSE](LICENSE) file for details.

## Contact

- **Developer**: Your Name
- **Email**: your.email@example.com
- **GitHub**: [@yourusername](https://github.com/yourusername)

## Changelog

### v1.0.0 (2024-XX-XX)
- Initial release
- Basic CRUD functionality
- User authentication