Column not found: 1054 Unknown column 'company.name' in 'where clause' (
    SQL:
    select
        count(*) as aggregate
    from
        (
            select
                '1' as `row_count`
            from
                `data`
            where
                not exists (
                    select
                        *
                    from
                        `leads`
                    where
                        `data`.`id` = `leads`.`data_id`
                )
                and exists (
                    select
                        *
                    from
                        `users`
                        inner join `user_data` on `users`.`id` = `user_data`.`user_id`
                    where
                        `data`.`id` = `user_data`.`data_id`
                        and `user_id` = 1
                        and `users`.`deleted_at` is null
                )
                and LOWER(`company`.`name`) LIKE % % hdfc % %
                and `data`.`deleted_at` is null