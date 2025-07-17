# 🚀 DEPLOYMENT GUIDE - YUWARAJA XVII

## 📋 Checklist Sebelum Deploy

### 1. Environment Configuration
```bash
# Copy file .env.production ke .env di server
cp .env.production .env

# Generate APP_KEY baru untuk production
php artisan key:generate

# Update konfigurasi database dan domain
```

### 2. Session & CSRF Optimization
```env
# Konfigurasi session untuk production
SESSION_LIFETIME=1440          # 24 jam (lebih lama dari default)
SESSION_SECURE_COOKIE=true     # Hanya untuk HTTPS
SESSION_HTTP_ONLY=true         # Prevent XSS
SESSION_SAME_SITE=lax         # CSRF protection
SESSION_DOMAIN=.yourdomain.com # Set domain yang benar
```

### 3. Database Setup
```bash
# Jalankan migration
php artisan migrate --force

# Seed data (jika diperlukan)
php artisan db:seed --force
```

### 4. Cache & Optimization
```bash
# Optimize untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Clear cache jika ada masalah
php artisan optimize:clear
```

### 5. File Permissions
```bash
# Set permission yang benar
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chown -R www-data:www-data storage/
chown -R www-data:www-data bootstrap/cache/
```

## 🛡️ Security Checklist

### 1. Environment
- [ ] APP_ENV=production
- [ ] APP_DEBUG=false
- [ ] APP_KEY generated
- [ ] Database credentials secure

### 2. HTTPS Configuration
- [ ] SSL certificate installed
- [ ] SESSION_SECURE_COOKIE=true
- [ ] Force HTTPS redirect

### 3. Session Security
- [ ] SESSION_LIFETIME appropriate (1440 = 24 hours)
- [ ] SESSION_DOMAIN set correctly
- [ ] SESSION_HTTP_ONLY=true

## 🚨 Troubleshooting CSRF Issues

### Common Issues:
1. **419 Page Expired**
   - Check session configuration
   - Verify database sessions table
   - Clear browser cookies

2. **Multiple Login Issues**
   - Increase SESSION_LIFETIME
   - Check SESSION_DOMAIN setting
   - Verify HTTPS configuration

3. **User Complaints**
   - Monitor logs for CSRF errors
   - Implement user-friendly error messages
   - Consider session timeout warnings

### Monitoring Commands:
```bash
# Check session table
php artisan tinker --execute="DB::table('sessions')->count()"

# Monitor CSRF errors
tail -f storage/logs/laravel.log | grep "CSRF"

# Check active sessions
php artisan tinker --execute="DB::table('sessions')->where('last_activity', '>', now()->subHours(1))->count()"
```

## 📊 Production Monitoring

### 1. Log Monitoring
- Monitor `storage/logs/laravel.log` for CSRF errors
- Set up log rotation
- Consider external logging service

### 2. Session Monitoring
```sql
-- Check active sessions
SELECT COUNT(*) as active_sessions 
FROM sessions 
WHERE last_activity > UNIX_TIMESTAMP(NOW() - INTERVAL 1 HOUR);

-- Clean old sessions
DELETE FROM sessions 
WHERE last_activity < UNIX_TIMESTAMP(NOW() - INTERVAL 24 HOUR);
```

### 3. User Experience
- Implement session timeout warnings
- Add auto-refresh for long forms
- Provide clear error messages

## 🔧 Performance Tips

1. **Session Cleanup**
   ```bash
   # Add to cron job (daily)
   0 2 * * * cd /path/to/project && php artisan session:gc
   ```

2. **Cache Strategy**
   - Use Redis for sessions in high-traffic
   - Enable OPcache
   - Use CDN for static assets

3. **Database Optimization**
   - Index sessions table properly
   - Regular cleanup of old sessions
   - Monitor database performance

## 📞 Support & Maintenance

### When Users Report "Web Error":
1. Check server logs first
2. Verify CSRF token configuration
3. Check session table status
4. Monitor active user sessions
5. Clear specific user sessions if needed

### Emergency Commands:
```bash
# Clear all sessions (last resort)
php artisan session:flush

# Restart services
sudo systemctl restart nginx
sudo systemctl restart php8.1-fpm
```