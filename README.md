# cache-deception-demo

[３０回 初心者のためのセキュリティ勉強会（オンライン開催）](https://sfb.connpass.com/event/279851/)で発表した  **Web Cache Deception Attack** のデモです

発表資料は[こちら](https://github.com/kuzushiki/cache-deception-demo/blob/main/slides-export.pdf)

なにか質問等あれば[Twitter](https://twitter.com/kuzu7shiki)で連絡ください

## 環境構築 (要Docker Compose)

1. 本リポジトリをクローンします
```
git clone git@github.com:kuzushiki/cache-deception-demo.git
```

2. ディレクトリを移動します
```
cd cache-deception-demo
```

3. Docker Composeでコンテナを起動します
```
docker compose up
```

4. URLにアクセスして、ページが表示されることを確認します
```
http://localhost:12345
```

## デモ手順

<被害者としての操作>

1. 適当なブラウザでURLにアクセスします
```
http://localhost:12345
```

2. ログインページにて、`admin:admin`でログインします

3. ログイン後の管理者ページ (http://localhost:12345/index.php) にてセンシティブな情報 (`phpinfo()`) が出力されていることを確認しましょう

4. (攻撃者が作成した罠リンクにアクセスする体で) 下記のようなURLにアクセスします  
管理者のページが返ってくることを確認しましょう

```
http://localhost:12345/index.php/hogehoge.css
```

<攻撃者としての操作>

5. 新しいシークレットウィンドウを立ち上げ、管理者ページ (http://localhost:12345/index.php) にアクセスします  
Cookieが発行されていないため、ログインページに飛ばされることでしょう

6. 手順4でアクセスしたURLにシークレットウィンドウでアクセスします  
キャッシュされた管理者ページのコンテンツが返ってくることを確認しましょう

7. `phpinfo()`の出力に被害者のCookieの値が含まれることを利用して、  
Cookie内の`PHPSESSID`の値を管理者ページ内の`PHPSESSID`の値に差し替えてみましょう

8. その後、管理者ページ (http://localhost:12345/index.php) にアクセスすると管理者ページのコンテンツが表示されます  
被害者になりすますことができました (いわゆるAccount Takeover)
