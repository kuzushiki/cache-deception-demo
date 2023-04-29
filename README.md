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

### <被害者としての操作>

1. 適当なブラウザでURLにアクセスします
```
http://localhost:12345
```

<img width="563" alt="image" src="https://user-images.githubusercontent.com/50363796/235282634-69cfabca-f0e4-4330-9358-9141e4da2159.png">

2. ログインページにて、ID:`admin` PW:`admin`でログインします

3. ログイン後の管理者ページ (http://localhost:12345/index.php) にてセンシティブな情報 (`phpinfo()`) が出力されていることを確認しましょう

<img width="962" alt="image" src="https://user-images.githubusercontent.com/50363796/235282661-8764f213-3bb7-4321-8a55-47b06699b917.png">

4. (攻撃者が作成した罠リンクにアクセスする体で) 下記のようなURLにアクセスします  
管理者のページが返ってくることを確認しましょう

```
http://localhost:12345/index.php/hogehoge.css
```

<img width="962" alt="image" src="https://user-images.githubusercontent.com/50363796/235282674-4ed0bb7c-8490-4acc-bc1a-8e61377a1dad.png">


### <攻撃者としての操作>

5. 新しいシークレットウィンドウを立ち上げ、管理者ページ (http://localhost:12345/index.php) にアクセスします  
Cookieが発行されていないため、ログインページに飛ばされることでしょう

<img width="610" alt="image" src="https://user-images.githubusercontent.com/50363796/235282687-57d48d56-64c6-41e9-a64b-56706901c6de.png">

6. 手順4でアクセスしたURLにシークレットウィンドウでアクセスします  
キャッシュされた管理者ページのコンテンツが返ってくることを確認しましょう

<img width="962" alt="image" src="https://user-images.githubusercontent.com/50363796/235282704-88eb165a-5e96-480b-bed8-04923b3704fa.png">

7. `phpinfo()`の出力に被害者のCookieの値が含まれることを利用して、  
Cookie内の`PHPSESSID`の値を管理者ページ内の`PHPSESSID`の値に差し替えてみましょう

<img width="962" alt="image" src="https://user-images.githubusercontent.com/50363796/235282727-563f9aee-7377-4c37-832e-4bcfe5f7acd0.png">

8. その後、管理者ページ (http://localhost:12345/index.php) にアクセスすると管理者ページのコンテンツが表示されます  
被害者になりすますことができました (いわゆるAccount Takeover)

<img width="962" alt="image" src="https://user-images.githubusercontent.com/50363796/235282750-5a106d45-03aa-4167-8ea9-f32c5459fce4.png">
