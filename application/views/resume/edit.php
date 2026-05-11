<?php
/** @var object $resume */
/** @var array  $sections */
/** @var array  $templates */

$s   = $sections;
$h   = isset($s['header'])   ? $s['header']   : [];
$sum = isset($s['summary'])  ? $s['summary']  : [];

$sections_nav = [
    ['key' => 'personal',    'icon' => 'fa-user',           'label' => 'Personal'],
    ['key' => 'summary',     'icon' => 'fa-align-left',     'label' => 'Summary'],
    ['key' => 'experience',  'icon' => 'fa-briefcase',      'label' => 'Experience'],
    ['key' => 'education',   'icon' => 'fa-graduation-cap', 'label' => 'Education'],
    ['key' => 'skills',      'icon' => 'fa-bolt',           'label' => 'Skills'],
    ['key' => 'projects',    'icon' => 'fa-diagram-project','label' => 'Projects'],
    ['key' => 'achievements','icon' => 'fa-award',          'label' => 'Awards'],
    ['key' => 'social',      'icon' => 'fa-link',           'label' => 'Social'],
];
?>

<div class="re-app">

    <!-- ============= LEFT SIDEBAR (section navigation) ============= -->
    <aside class="re-sidebar" aria-label="Section navigation">
        <div class="re-sidebar__title">Sections</div>
        <?php foreach ($sections_nav as $i => $sec): ?>
            <a href="#card-<?= $sec['key']; ?>"
               class="re-side-link <?= $i === 0 ? 'is-active' : ''; ?>"
               data-target="<?= $sec['key']; ?>">
                <i class="fa-solid <?= $sec['icon']; ?>"></i>
                <span><?= $sec['label']; ?></span>
            </a>
        <?php endforeach; ?>
    </aside>

    <!-- ============= CENTER — FORM EDITOR ============= -->
    <section class="re-editor">

        <!-- Header card -->
        <div class="re-editor__header re-fade-up">
            <div style="flex:1; min-width:240px;">
                <div class="re-field__label">Resume title</div>
                <input type="text" id="resumeTitle" class="re-title-input"
                       value="<?= htmlspecialchars($resume->title); ?>"
                       placeholder="Untitled Resume">
            </div>

            <div class="re-progress">
                <div class="re-progress__top">
                    <span>Completion</span>
                    <b id="progressText">0%</b>
                </div>
                <div class="re-progress__bar">
                    <div class="re-progress__fill" id="progressFill"></div>
                </div>
            </div>
        </div>

        <!-- ===== PERSONAL INFORMATION ===== -->
        <article class="re-card re-fade-up" id="card-personal" data-open="true">
            <button type="button" class="re-card__head">
                <span class="re-card__icon"><i class="fa-solid fa-user"></i></span>
                <div class="re-card__title">
                    <h3>Personal Information</h3>
                    <p>Your contact details and location</p>
                </div>
                <i class="fa-solid fa-chevron-down re-card__chevron"></i>
            </button>
            <div class="re-card__body">
                <div class="re-card__body-inner">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="re-field">
                                <label class="re-field__label">Full name</label>
                                <div class="re-input-wrap">
                                    <i class="fa-solid fa-user re-input-icon"></i>
                                    <input type="text" class="re-input" data-bind="header.name" placeholder="John Doe">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="re-field">
                                <label class="re-field__label">Professional title</label>
                                <div class="re-input-wrap">
                                    <i class="fa-solid fa-briefcase re-input-icon"></i>
                                    <input type="text" class="re-input" data-bind="header.role" placeholder="Senior Frontend Engineer">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="re-field">
                                <label class="re-field__label">Email</label>
                                <div class="re-input-wrap">
                                    <i class="fa-solid fa-envelope re-input-icon"></i>
                                    <input type="email" class="re-input" data-bind="header.email" placeholder="you@example.com">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="re-field">
                                <label class="re-field__label">Phone</label>
                                <div class="re-input-wrap">
                                    <i class="fa-solid fa-phone re-input-icon"></i>
                                    <input type="text" class="re-input" data-bind="header.phone" placeholder="+91 98765 43210">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="re-field">
                                <label class="re-field__label">Location</label>
                                <div class="re-input-wrap">
                                    <i class="fa-solid fa-location-dot re-input-icon"></i>
                                    <input type="text" class="re-input" data-bind="header.location" placeholder="Bengaluru, India">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <!-- ===== PROFILE SUMMARY ===== -->
        <article class="re-card re-fade-up" id="card-summary" data-open="false">
            <button type="button" class="re-card__head">
                <span class="re-card__icon"><i class="fa-solid fa-align-left"></i></span>
                <div class="re-card__title">
                    <h3>Profile Summary</h3>
                    <p>A short pitch about who you are (2–4 sentences)</p>
                </div>
                <i class="fa-solid fa-chevron-down re-card__chevron"></i>
            </button>
            <div class="re-card__body">
                <div class="re-card__body-inner">
                    <div class="re-field">
                        <textarea class="re-textarea" rows="5" data-bind="summary.text"
                                  placeholder="Results-driven engineer with 5+ years of experience building scalable web applications…"></textarea>
                    </div>
                </div>
            </div>
        </article>

        <!-- ===== EXPERIENCE ===== -->
        <article class="re-card re-fade-up" id="card-experience" data-open="false">
            <button type="button" class="re-card__head">
                <span class="re-card__icon"><i class="fa-solid fa-briefcase"></i></span>
                <div class="re-card__title">
                    <h3>Work Experience</h3>
                    <p>Roles you've held, most recent first</p>
                </div>
                <i class="fa-solid fa-chevron-down re-card__chevron"></i>
            </button>
            <div class="re-card__body">
                <div class="re-card__body-inner" data-repeater="experience">
                    <div class="re-repeater-list"></div>
                    <template>
                        <div class="re-item">
                            <div class="re-item__head">
                                <span class="re-item__num">#1</span>
                                <button type="button" class="re-item__remove" aria-label="Remove">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="re-field">
                                        <label class="re-field__label">Role / Title</label>
                                        <input type="text" class="re-input" data-field="title" placeholder="Senior Developer">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="re-field">
                                        <label class="re-field__label">Company</label>
                                        <input type="text" class="re-input" data-field="subtitle" placeholder="Acme Inc.">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="re-field">
                                        <label class="re-field__label">Period</label>
                                        <input type="text" class="re-input" data-field="period" placeholder="Jan 2022 — Present">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="re-field">
                                        <label class="re-field__label">Description</label>
                                        <textarea class="re-textarea" rows="3" data-field="description"
                                                  placeholder="Led a team of 5, shipped X feature…"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <button type="button" class="re-add-btn"><i class="fa-solid fa-plus"></i> Add experience</button>
                </div>
            </div>
        </article>

        <!-- ===== EDUCATION ===== -->
        <article class="re-card re-fade-up" id="card-education" data-open="false">
            <button type="button" class="re-card__head">
                <span class="re-card__icon"><i class="fa-solid fa-graduation-cap"></i></span>
                <div class="re-card__title">
                    <h3>Education</h3>
                    <p>Schools, colleges, certifications</p>
                </div>
                <i class="fa-solid fa-chevron-down re-card__chevron"></i>
            </button>
            <div class="re-card__body">
                <div class="re-card__body-inner" data-repeater="education">
                    <div class="re-repeater-list"></div>
                    <template>
                        <div class="re-item">
                            <div class="re-item__head">
                                <span class="re-item__num">#1</span>
                                <button type="button" class="re-item__remove"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="re-field">
                                        <label class="re-field__label">Degree / Course</label>
                                        <input type="text" class="re-input" data-field="title" placeholder="B.Tech Computer Science">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="re-field">
                                        <label class="re-field__label">Institution</label>
                                        <input type="text" class="re-input" data-field="subtitle" placeholder="IIT Delhi">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="re-field">
                                        <label class="re-field__label">Period</label>
                                        <input type="text" class="re-input" data-field="period" placeholder="2018 — 2022">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="re-field">
                                        <label class="re-field__label">Notes</label>
                                        <textarea class="re-textarea" rows="2" data-field="description"
                                                  placeholder="GPA 9.2, Activities…"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <button type="button" class="re-add-btn"><i class="fa-solid fa-plus"></i> Add education</button>
                </div>
            </div>
        </article>

        <!-- ===== SKILLS ===== -->
        <article class="re-card re-fade-up" id="card-skills" data-open="false">
            <button type="button" class="re-card__head">
                <span class="re-card__icon"><i class="fa-solid fa-bolt"></i></span>
                <div class="re-card__title">
                    <h3>Skills</h3>
                    <p>Press Enter or comma after each skill</p>
                </div>
                <i class="fa-solid fa-chevron-down re-card__chevron"></i>
            </button>
            <div class="re-card__body">
                <div class="re-card__body-inner">
                    <div class="re-field">
                        <label class="re-field__label">Add your skills</label>
                        <div class="re-chips" data-chips-key="skills">
                            <input type="text" class="re-chip-input" placeholder="Type a skill and press Enter…">
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <!-- ===== PROJECTS ===== -->
        <article class="re-card re-fade-up" id="card-projects" data-open="false">
            <button type="button" class="re-card__head">
                <span class="re-card__icon"><i class="fa-solid fa-diagram-project"></i></span>
                <div class="re-card__title">
                    <h3>Projects</h3>
                    <p>Notable side or work projects</p>
                </div>
                <i class="fa-solid fa-chevron-down re-card__chevron"></i>
            </button>
            <div class="re-card__body">
                <div class="re-card__body-inner" data-repeater="projects">
                    <div class="re-repeater-list"></div>
                    <template>
                        <div class="re-item">
                            <div class="re-item__head">
                                <span class="re-item__num">#1</span>
                                <button type="button" class="re-item__remove"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="re-field">
                                        <label class="re-field__label">Project name</label>
                                        <input type="text" class="re-input" data-field="title" placeholder="Awesome App">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="re-field">
                                        <label class="re-field__label">Stack / Role</label>
                                        <input type="text" class="re-input" data-field="subtitle" placeholder="React, Node, MongoDB">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="re-field">
                                        <label class="re-field__label">Date / Period</label>
                                        <input type="text" class="re-input" data-field="period" placeholder="2024">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="re-field">
                                        <label class="re-field__label">Description</label>
                                        <textarea class="re-textarea" rows="3" data-field="description"
                                                  placeholder="What the project does, your contribution, impact…"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <button type="button" class="re-add-btn"><i class="fa-solid fa-plus"></i> Add project</button>
                </div>
            </div>
        </article>

        <!-- ===== CERTIFICATIONS / AWARDS (stored under "achievements") ===== -->
        <article class="re-card re-fade-up" id="card-achievements" data-open="false">
            <button type="button" class="re-card__head">
                <span class="re-card__icon"><i class="fa-solid fa-award"></i></span>
                <div class="re-card__title">
                    <h3>Certifications & Achievements</h3>
                    <p>Courses completed, awards, badges</p>
                </div>
                <i class="fa-solid fa-chevron-down re-card__chevron"></i>
            </button>
            <div class="re-card__body">
                <div class="re-card__body-inner" data-repeater="achievements">
                    <div class="re-repeater-list"></div>
                    <template>
                        <div class="re-item">
                            <div class="re-item__head">
                                <span class="re-item__num">#1</span>
                                <button type="button" class="re-item__remove"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="re-field">
                                        <label class="re-field__label">Title</label>
                                        <input type="text" class="re-input" data-field="title" placeholder="AWS Certified Developer">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="re-field">
                                        <label class="re-field__label">Issuer / Org</label>
                                        <input type="text" class="re-input" data-field="subtitle" placeholder="Amazon Web Services">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="re-field">
                                        <label class="re-field__label">Date</label>
                                        <input type="text" class="re-input" data-field="dateLabel" placeholder="May 2024">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="re-field">
                                        <label class="re-field__label">Notes</label>
                                        <textarea class="re-textarea" rows="2" data-field="description"
                                                  placeholder="Credential ID, skills validated…"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <button type="button" class="re-add-btn"><i class="fa-solid fa-plus"></i> Add certification</button>
                </div>
            </div>
        </article>

        <!-- ===== SOCIAL LINKS ===== -->
        <article class="re-card re-fade-up" id="card-social" data-open="false">
            <button type="button" class="re-card__head">
                <span class="re-card__icon"><i class="fa-solid fa-link"></i></span>
                <div class="re-card__title">
                    <h3>Social Links</h3>
                    <p>LinkedIn, GitHub, portfolio, etc.</p>
                </div>
                <i class="fa-solid fa-chevron-down re-card__chevron"></i>
            </button>
            <div class="re-card__body">
                <div class="re-card__body-inner">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="re-field">
                                <label class="re-field__label">LinkedIn</label>
                                <div class="re-input-wrap">
                                    <i class="fa-brands fa-linkedin re-input-icon"></i>
                                    <input type="text" class="re-input" data-bind="header.linkedin" placeholder="linkedin.com/in/you">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="re-field">
                                <label class="re-field__label">GitHub</label>
                                <div class="re-input-wrap">
                                    <i class="fa-brands fa-github re-input-icon"></i>
                                    <input type="text" class="re-input" data-bind="header.github" placeholder="github.com/you">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="re-field">
                                <label class="re-field__label">Portfolio / Website</label>
                                <div class="re-input-wrap">
                                    <i class="fa-solid fa-globe re-input-icon"></i>
                                    <input type="text" class="re-input" data-bind="header.website" placeholder="https://yourname.dev">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="re-field">
                                <label class="re-field__label">Twitter / X</label>
                                <div class="re-input-wrap">
                                    <i class="fa-brands fa-x-twitter re-input-icon"></i>
                                    <input type="text" class="re-input" data-bind="header.twitter" placeholder="@yourhandle">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <div style="height: 80px;"></div>
    </section>

    <!-- ============= RIGHT — LIVE A4 PREVIEW ============= -->
    <aside class="re-preview-pane" id="previewPane" aria-label="Live preview">
        <div class="re-toolbar">
            <select id="templateSelect" class="re-toolbar__select" title="Switch template">
                <?php foreach ($templates as $t): ?>
                    <option value="<?= (int) $t->id; ?>" <?= ((int) $t->id === (int) $resume->template_id) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($t->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div class="re-toolbar__spacer"></div>

            <div class="re-zoom" title="Zoom">
                <button id="zoomOut" type="button"><i class="fa-solid fa-minus"></i></button>
                <span class="re-zoom__value" id="zoomValue">62%</span>
                <button id="zoomIn" type="button"><i class="fa-solid fa-plus"></i></button>
            </div>
            <button id="zoomReset" type="button" class="re-btn re-btn--icon" title="Fit">
                <i class="fa-solid fa-expand"></i>
            </button>
        </div>

        <div class="re-canvas" id="a4Canvas">
            <div class="re-a4-wrap" id="a4Wrap">
                <div class="re-a4" id="a4Sheet">
                    <div id="previewBody"></div>
                </div>
            </div>
        </div>
    </aside>
</div>

<!-- Mobile drawer toggle -->
<button class="re-mobile-toggle" id="mobileToggle" type="button" aria-label="Toggle preview">
    <i class="fa-solid fa-eye"></i>
</button>

<!-- Sticky action footer -->
<div class="re-action-bar">
    <span class="re-action-bar__text"><b>Resume #<?= (int) $resume->id; ?></b> · changes save automatically</span>
    <button type="button" id="btnSave" class="re-btn re-btn--ghost">
        <i class="fa-solid fa-floppy-disk"></i> Save
    </button>
    <button type="button" id="btnDownload" class="re-btn re-btn--primary">
        <i class="fa-solid fa-arrow-down"></i> Download PDF
    </button>
</div>

<!-- Bootstrap data for JS -->
<script>
    window.__RE_BOOT__ = {
        resumeId:   <?= (int) $resume->id; ?>,
        templateId: <?= (int) $resume->template_id; ?>,
        title:      <?= json_encode($resume->title); ?>,
        sections:   <?= json_encode($sections, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
    };
</script>
