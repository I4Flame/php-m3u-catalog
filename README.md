# PHP M3U IPTV Kataloğu
Bu proje, bir M3U URL kaynağından dizi ve film içeriklerini çekip listeleyen basit bir PHP uygulamasıdır.
## Gereksinimler
- Docker ve Docker Compose
## Çalıştırma Adımları
1. Proje klasörüne terminal ile gidin.
2. Aşağıdaki komutu çalıştırın:
   ```bash
   docker-compose up --build -d
   ```
3. İşlem tamamlandığında tarayıcıda `http://localhost:8000` adresine gidin.
Projeyi durdurmak için:
```bash
docker-compose down
```