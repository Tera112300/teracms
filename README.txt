# TeraCms

Laravel製の自作CMS

# 初期ユーザー

ユーザー名:UserName
メールアドレス:User@mailaddress.com
パスワード：password


# テーマはDemoThemeを用意



# 自作テーマ作成に必要なファイル

テーマ作成する際に絶対に必要なファイル(テーマの切り替え自体は管理画面から特別な設定無しで変更可能)

・index.php
・webTheme.php(ルーティングファイル)
・自作テーマコントローラー01


public
└ themes
　 ├ DemoTheme
　 │ ├ index.php等
　 │ └ webTheme.php(ルーティングファイル)
　 ├ 自作テーマ01
　 │ ├ index.php等
　 │ └ webTheme.php(ルーティングファイル)
　 └ 自作テーマ02
　 　 ├ index.php等
　 　 └ webTheme.php(ルーティングファイル)

app
└ Http
　 └ Controllers
　 　 └ Themes
　 　 　 ├ DemoTheme
　 　 　 ├ 自作テーマコントローラー01
　 　 　 └ 自作テーマコントローラー02

# 初期ユーザー情報
ユーザー名：admin

メールアドレス:admin@gmail.com

パスワード：admin

投稿ステータス：管理者



# 注意点
xamppポータブル版の中にcmsを入れているのですぐにテストを確認することが可能ですが、既にXamppをインストールされている場合は「setup_xampp.bat」を起動後、
「xampp-control.exe」を開いて下さい(インストールはされません)


# Author

* 作成者 terao
