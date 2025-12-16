<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_create_booking');

        DB::unprepared(<<<'SQL'
CREATE PROCEDURE sp_create_booking(
    IN p_booking_id VARCHAR(255),
    IN p_user_id BIGINT,
    IN p_room_id VARCHAR(8),
    IN p_check_in DATE,
    IN p_check_out DATE,
    IN p_guest_count INT
)
BEGIN
    DECLARE room_avail INT;

    START TRANSACTION;

    SELECT availability INTO room_avail
    FROM rooms
    WHERE room_id = CAST(p_room_id AS CHAR)
    FOR UPDATE;

    IF room_avail IS NULL OR room_avail <= 0 THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Room not available';
    END IF;

    INSERT INTO bookings (
        booking_id, user_id, room_id,
        check_in_date, check_out_date,
        guest_count, booking_status,
        created_at, updated_at
    )
    VALUES (
        p_booking_id, p_user_id, p_room_id,
        p_check_in, p_check_out,
        p_guest_count, 'pending',
        NOW(), NOW()
    );

    UPDATE rooms
    SET availability = availability - 1
    WHERE room_id = CAST(p_room_id AS CHAR);

    COMMIT;
END;
SQL);
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_create_booking');
    }
};
