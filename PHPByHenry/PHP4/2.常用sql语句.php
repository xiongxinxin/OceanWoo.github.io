<?php 
	/*
		操作数据库: 增删改查(常用方法)
		
		插入:

		插入所有默认字段
		INSERT INTO user VALUES();

		插入所有字段并指定值
		INSERT INTO user VALUES(NULL,"小吴","男",18,"13651322451")
	
		插入字段并给值(常用)
		INSERT INTO user(name,sex) VALUES("小耿","男");

		官方推荐写法
		INSERT INTO `user`(`name`,`sex`) VALUES("小耿","男");		


		更新: 

		UPDATE user SET age = 20; 更改所有字段的是年龄值为20
	
		更改id为3的字段
		UPDATE user SET age = 20,sex = '女' where id = 3;


		查询:

		SELECT * FROM user; // 查找所有user表中的字段
		
		查找表中id为3的所有数据
		SELECT * FROM user WHERE id = 3;
	

		查找符合某个条件的所有字段
		SELECT * FROM user WHERE id > 3;

		模糊查询
		SELECT * FROM user WHERE name LIKE "%五️⃣%";


		删除: 
		删除所有表
		DELETE FROM user;

		删除符合某个条件的表
		DELETE FROM user WHERE id = 5;

		===================================================

		升序方法 ascending 
		SELECT * FROM user ORDER BY id ASC;

		降序方法 decending 
		SELECT * FROM user ORDER BY id DESC;
	*/



 ?>