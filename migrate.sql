
   INFO  Running migrations.  

  2023_04_26_111632_create_links_table ............................................................  
  ⇂ create table `links` (`book_id` int unsigned not null, `author_id` int unsigned not null, `author_order` tinyint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `links` add constraint `links_book_id_foreign` foreign key (`book_id`) references `books` (`id`)  
  ⇂ alter table `links` add constraint `links_author_id_foreign` foreign key (`author_id`) references `authors` (`id`)  
  ⇂ alter table `links` add primary key (`book_id`, `author_id`)  

