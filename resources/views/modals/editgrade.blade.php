@if(isset($enrollment))
    <!-- Edit Grade Modal -->
    <div class="modal fade" id="editGradeModal{{ $enrollment->id }}" tabindex="-1"
        aria-labelledby="editGradeModalLabel{{ $enrollment->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title fw-bold" id="editGradeModalLabel{{ $enrollment->id }}">
                        Edit Grade for {{ $enrollment->student->name }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('grades.update', $enrollment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="grade" class="form-label">Grade</label>
                            <select name="grade" id="grade" class="form-select">
                                @php
                                    $gradeOptions = [1.0, 1.25, 1.50, 1.75, 2.0, 2.25, 2.50, 2.75, 3.0, 3.25, 3.50, 3.75, 4.0, 4.25, 4.50, 4.75, 5.0];
                                @endphp
                                @foreach ($gradeOptions as $grade)
                                    <option value="{{ $grade }}" 
                                        {{ $enrollment->grades->isNotEmpty() && $enrollment->grades->first()->grade == $grade ? 'selected' : '' }}>
                                        {{ $grade }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
