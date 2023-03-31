# web for 東元堆高機

## clone 程式, 並使用 docker 建構環境
```
git clone ...
docker-compose up -d
cp .env.example .env
```

## 進入容器並執行 composer install
```
docker exec -it xxx_container_id_xxx /bin/bash
composer install
```
## 匯入 company.sql 並修改 .env 配置資料庫
