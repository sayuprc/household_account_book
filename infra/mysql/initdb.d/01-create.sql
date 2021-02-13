DROP TABLE IF EXISTS receipts;

DROP TABLE IF EXISTS receipts_detail;

DROP TABLE IF EXISTS categories;

CREATE TABLE receipts_detail (
	receipt_id bigint not null, -- 親レシートID
	serial bigint not null, 		-- 連番
	item_name varchar(256), 		-- 商品名
	quantity int, 							-- 個数
	amount decimal(10, 2), 			-- 金額(税込み)
	purchased_at datetime,  		-- 購入日
	paymented_at datetime, 			-- 支払日
	payment_type int, 					-- 支払い方法
	payment_count int, 					-- 支払い回数
	is_payed bit default 0, 		-- 支払いフラグ 0 => 未決済, 1 => 決済済み
	category_id int, 						-- カテゴリID
	memo text, 									-- 備考
	primary key(receipt_id, serial)
);

CREATE TABLE categories (
	category_id bigint not null,
	category_name varchar(256),
	primary key(category_id)
);

CREATE TABLE receipts (
	receipt_id bigint not null, 	-- レシートID
  receipt_name varchar(256),    -- 名前
	total_amount decimal(10, 2), 	-- 合計金額(税込み)
  purchased_at datetime,        -- 購入日
  created_at datetime,          -- 作成日
	primary key(receipt_id)
);

