<?php
class Course
{
    private $id;
    private $course_name;
    private $schedule_days;
    private $start_time;
    private $end_time;
    private $start_date;
    private $end_date;
    private $description;

    // --- Getters ---
    public function get_id() { return $this->id; }
    public function get_course_name() { return $this->course_name; }
    public function get_schedule_days() { return $this->schedule_days; }
    public function get_start_time() { return $this->start_time; }
    public function get_end_time() { return $this->end_time; }
    public function get_start_date() { return $this->start_date; }
    public function get_end_date() { return $this->end_date; }
    public function get_description() { return $this->description; }

    // --- Setters ---
    public function set_id($id) { $this->id = $id; }
    public function set_course_name($course_name) { $this->course_name = $course_name; }
    public function set_schedule_days($schedule_days) { $this->schedule_days = $schedule_days; }
    public function set_start_time($start_time) { $this->start_time = $start_time; }
    public function set_end_time($end_time) { $this->end_time = $end_time; }
    public function set_start_date($start_date) { $this->start_date = $start_date; }
    public function set_end_date($end_date) { $this->end_date = $end_date; }
    public function set_description($description) { $this->description = $description; }

    private function formatDate($date) {
        try {
            return (new DateTime($date))->format('Y-m-d');
        } catch (Exception $e) {
            return '0000-00-00';
        }
    }

    public function store()
    {
        $db = new Database();
        $sql = "insert into courses (course_name, schedule_days, start_time, end_time, start_date, end_date, description) values (:course_name, :schedule_days, :start_time, :end_time, :start_date, :end_date, :description)";
        $db->execute($sql, [
            'course_name' => strval($this->course_name),
            'schedule_days' => strval($this->schedule_days),
            'start_time' => strval($this->start_time),
            'end_time' => strval($this->end_time),
            'start_date' => $this->formatDate($this->start_date),
            'end_date' => $this->formatDate($this->end_date),
            'description' => strval($this->description)
        ]);
        return json_encode(['result' => true, 'message' => 'Course record has been inserted successfully']);
    }

    public function destroy()
    {
        $db = new Database();
        $db->execute("delete from courses where id = :id", ['id' => intval($this->id)]);
        return json_encode(['result' => true, 'message' => 'Course record has been deleted successfully']);
    }

    public function update()
    {
        $db = new Database();
        $sql = "update courses set course_name = :course_name, schedule_days = :schedule_days, start_time = :start_time, end_time = :end_time, start_date = :start_date, end_date = :end_date, description = :description where id = :id";
        $db->execute($sql, [
            'course_name' => strval($this->course_name),
            'schedule_days' => strval($this->schedule_days),
            'start_time' => strval($this->start_time),
            'end_time' => strval($this->end_time),
            'start_date' => $this->formatDate($this->start_date),
            'end_date' => $this->formatDate($this->end_date),
            'description' => strval($this->description),
            'id' => intval($this->id)
        ]);
        return json_encode(['result' => true, 'message' => 'Course record has been updated successfully', 'id' => $this->id]);
    }
    public function index($search) 
    {
        $db = new Database();

        $sql = "select id, course_name, schedule_days, start_time, end_time, start_date, end_date, description from courses";
        $params = [];

        if($search) {
            $sql .= ' where course_name like :course_name';
            $params['course_name'] = '%'. $search . '%';
        }

        $courses = $db->executeAssoc($sql, $params);
        return json_encode([
            'result' => true,
            'message' => "Get all courses successfully",
            'courses' => $courses
        ]);
    }
}