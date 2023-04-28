# cache-deception-demo

Web Cache Deception Attackのデモです。

## 環境構築 (要Docker Compose)

1. 本リポジトリをクローン
```
git clone git@github.com:kuzushiki/cache-deception-demo.git
```

2. ディレクトリを移動
```
cd cache-deception-demo
```

3. Docker Composeでコンテナを起動
```
docker compose up
```

4. URLにアクセス
```
http://localhost:12345
```

## デモ手順

1. 適当なブラウザでURLにアクセス
```
http://localhost:12345
```

2. ログインページにて、`admin:admin`でログイン

3. ログイン後の管理者ページ (http://localhost:12345/index.php) にてセンシティブな情報 (phpinfo) が出力されていることを確認

4. (攻撃者が作成した罠リンクにアクセスする体で) 下記のようなURLにアクセス。管理者のページが返ってくることを確認
```
http://localhost:12345/index.php/hogehoge.css
```

5. 新しいシークレットウィンドウを立ち上げ、管理者ページ (http://localhost:12345/index.php) にアクセス。ログインページに飛ばされることを確認

6. 手順4でアクセスしたURLにシークレットウィンドウでアクセス。管理者ページのコンテンツが返ってくることを確認

7. Cookieの値を管理者ページ内の`PHPSESSID`の値に差し替えると管理者になりすませる (いわゆるAccount Takeover)
