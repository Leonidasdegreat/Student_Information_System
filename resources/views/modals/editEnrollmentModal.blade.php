<div class="modal fade" id="editEnrollmentModal" tabindex="-1" aria-labelledby="editEnrollmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEnrollmentModalLabel">Edit Enrollment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEnrollmentForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit_id">

                    <div class="mb-3">
                        <label for="edit_student_id" class="form-label">Search Student</label>
                        <select class="form-select select2" name="student_id" id="edit_student_id" required>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->id }} - {{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_subject_id" class="form-label">Search Subject</label>
                        <select class="form-select select2" name="subject_id" id="edit_subject_id" required>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->id }} - {{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_enrollment_date" class="form-label">Enrollment Date</label>
                        <input type="date" class="form-control" name="enrollment_date" id="edit_enrollment_date" required>
                    </div>

                    <button type="submit" class="btn btn-warning">Update Enrollment</button>
                </form>
            </div>
        </div>
    </div>
</div>
