<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$bu = base_url();
?>
<div class="ra-rc-page">
    <div class="ra-rc-bg" aria-hidden="true">
        <div class="ra-rc-bg__orb ra-rc-bg__orb--1"></div>
        <div class="ra-rc-bg__orb ra-rc-bg__orb--2"></div>
        <div class="ra-rc-bg__orb ra-rc-bg__orb--3"></div>
        <div class="ra-rc-bg__grid"></div>
    </div>

    <div class="ra-rc-inner">
        <header class="ra-rc-hero">
            <span class="ra-rc-badge">Internmo · AI</span>
            <h1>AI Powered ATS Resume Checker</h1>
            <p>Upload your resume and get instant ATS score, keyword analysis, and AI improvement suggestions.</p>
            <div class="ra-rc-hero__cta">
                <button type="button" class="ra-rc-btn ra-rc-btn--primary" id="ra-rc-hero-upload">Upload Resume</button>
                <button type="button" class="ra-rc-btn ra-rc-btn--ghost" id="ra-rc-hero-check">Check ATS Score</button>
            </div>
        </header>

        <div class="ra-rc-grid">
            <div class="ra-rc-main">
                <section class="ra-rc-card ra-rc-reveal" aria-labelledby="ra-rc-upload-title">
                    <h2 class="ra-rc-card__title" id="ra-rc-upload-title">Resume upload</h2>
                    <input type="file" id="ra-rc-file" class="ra-rc-sr-only" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" aria-label="Upload resume file">

                    <div class="ra-rc-dropzone" id="ra-rc-dropzone" role="button" tabindex="0" aria-describedby="ra-rc-drop-help">
                        <div class="ra-rc-dropzone__scan" aria-hidden="true"></div>
                        <div class="ra-rc-dropzone__icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        </div>
                        <h3>Drag &amp; drop your resume</h3>
                        <p id="ra-rc-drop-help">or click to browse  -  PDF, DOC, DOCX up to 10&nbsp;MB</p>
                        <div class="ra-rc-dropzone__formats">
                            <span class="ra-rc-format-pill">PDF</span>
                            <span class="ra-rc-format-pill">DOC</span>
                            <span class="ra-rc-format-pill">DOCX</span>
                        </div>
                        <div class="ra-rc-progress-wrap" id="ra-rc-progress-wrap">
                            <div class="ra-rc-progress-bar"><span id="ra-rc-progress-bar"></span></div>
                        </div>
                        <div class="ra-rc-file-preview" id="ra-rc-file-preview">
                            <div class="ra-rc-file-preview__thumb" aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            </div>
                            <div class="ra-rc-file-preview__meta">
                                <div class="ra-rc-file-preview__name" id="ra-rc-preview-filename">-</div>
                                <div class="ra-rc-file-preview__size" id="ra-rc-preview-filesize">-</div>
                            </div>
                        </div>
                        <p class="ra-rc-note"><strong>ATS tip:</strong> Use standard section headings (Experience, Education, Skills) and avoid text boxes that parsers cannot read.</p>
                    </div>

                    <div class="ra-rc-field">
                        <div class="ra-rc-label-row">
                            <label class="ra-rc-label" for="ra-rc-jobdesc">Job description</label>
                            <span class="ra-rc-ai-badge">AI job match</span>
                        </div>
                        <textarea id="ra-rc-jobdesc" class="ra-rc-textarea" maxlength="5000" placeholder="Paste job description here for better ATS matching..." rows="5"></textarea>
                        <div class="ra-rc-counter" id="ra-rc-jd-count">0 / 5000</div>
                        <div class="ra-rc-tips">
                            <h4>Smart tips</h4>
                            <ul>
                                <li>Paste the full JD so we can compare required skills and phrasing.</li>
                                <li>Include responsibilities and &ldquo;must-have&rdquo; bullets for tighter keyword coverage.</li>
                                <li>Longer descriptions yield more accurate match scores (demo mode uses length heuristics).</li>
                            </ul>
                        </div>
                    </div>

                    <div class="ra-rc-actions">
                        <button type="button" class="ra-rc-btn ra-rc-btn--primary" id="ra-rc-btn-analyze" disabled>Analyze Resume</button>
                        <button type="button" class="ra-rc-btn ra-rc-btn--outline" data-scroll-improve disabled>Improve Resume</button>
                        <button type="button" class="ra-rc-btn ra-rc-btn--ghost" id="ra-rc-btn-recheck" disabled>Recheck Resume</button>
                    </div>
                </section>

                <section class="ra-rc-results ra-rc-mt" id="ra-rc-results" aria-live="polite">
                    <h2 class="ra-rc-section-title">AI analysis dashboard</h2>
                    <p class="ra-rc-section-sub">Simulated scores for UI preview  -  connect your backend to pipe real NLP and ATS engines.</p>

                    <div class="ra-rc-dashboard">
                        <div class="ra-rc-dash-card ra-rc-score-wrap">
                            <div class="ra-rc-dash-card__label">Overall ATS score</div>
                            <div class="ra-rc-score-row">
                                <div class="ra-rc-ring" aria-hidden="true">
                                    <svg width="140" height="140" viewBox="0 0 120 120">
                                        <defs>
                                            <linearGradient id="ra-rc-ring-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" stop-color="#f59e0b"/>
                                                <stop offset="100%" stop-color="#d97706"/>
                                            </linearGradient>
                                        </defs>
                                        <circle class="ra-rc-ring__bg" cx="60" cy="60" r="54"/>
                                        <circle class="ra-rc-ring__fg" id="ra-rc-ring-fg" cx="60" cy="60" r="54"/>
                                    </svg>
                                    <div class="ra-rc-ring__label">
                                        <div>
                                            <div class="ra-rc-ring__num" id="ra-rc-ats-num">0%</div>
                                            <div class="ra-rc-ring__sub">ATS</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ra-rc-strength">
                                    <h4>Resume strength</h4>
                                    <p>Your layout is parser-friendly with clear sections. After analysis, we highlight where recruiters and ATS parsers spend the most attention.</p>
                                </div>
                            </div>
                        </div>

                        <div class="ra-rc-dash-card">
                            <div class="ra-rc-dash-card__label">Weakness analysis</div>
                            <p class="ra-rc-dash-card__value" style="font-size:0.95rem;font-weight:500;line-height:1.45;color:#475569" id="ra-rc-weakness">Run an analysis to see personalized gaps.</p>
                        </div>

                        <div class="ra-rc-dash-card">
                            <div class="ra-rc-dash-card__label">Missing keywords</div>
                            <div class="ra-rc-chip-row" style="margin-top:0.5rem">
                                <span class="ra-rc-chip ra-rc-chip--miss">Stakeholder management</span>
                                <span class="ra-rc-chip ra-rc-chip--miss">KPI ownership</span>
                                <span class="ra-rc-chip ra-rc-chip--miss">Cross-functional</span>
                            </div>
                        </div>

                        <div class="ra-rc-dash-card">
                            <div class="ra-rc-dash-card__label">Formatting check</div>
                            <div class="ra-rc-dash-card__value"><span id="ra-rc-val-format">0%</span></div>
                        </div>

                        <div class="ra-rc-dash-card">
                            <div class="ra-rc-dash-card__label">Grammar score</div>
                            <div class="ra-rc-dash-card__value"><span id="ra-rc-val-grammar">0%</span></div>
                        </div>

                        <div class="ra-rc-dash-card">
                            <div class="ra-rc-dash-card__label">Skills match</div>
                            <div class="ra-rc-dash-card__value"><span id="ra-rc-val-skills">0%</span></div>
                        </div>

                        <div class="ra-rc-dash-card">
                            <div class="ra-rc-dash-card__label">Experience analysis</div>
                            <div class="ra-rc-dash-card__value"><span id="ra-rc-val-exp">0%</span></div>
                        </div>
                    </div>

                    <div class="ra-rc-kw-section ra-rc-reveal">
                        <h3 class="ra-rc-section-title" style="font-size:1.15rem">Keyword analysis</h3>
                        <p class="ra-rc-section-sub" style="margin-bottom:0.75rem">Visual map of gaps and boosts for your next edit pass.</p>
                        <h4 class="ra-rc-label" style="margin-top:1rem">Missing keywords</h4>
                        <div class="ra-rc-chip-row">
                            <span class="ra-rc-chip ra-rc-chip--miss">OKR alignment</span>
                            <span class="ra-rc-chip ra-rc-chip--miss">A/B testing</span>
                            <span class="ra-rc-chip ra-rc-chip--miss">SQL analytics</span>
                        </div>
                        <h4 class="ra-rc-label" style="margin-top:1rem">Recommended skills</h4>
                        <div class="ra-rc-chip-row">
                            <span class="ra-rc-chip ra-rc-chip--rec">Product strategy</span>
                            <span class="ra-rc-chip ra-rc-chip--rec">Roadmapping</span>
                            <span class="ra-rc-chip ra-rc-chip--rec">User research</span>
                        </div>
                        <h4 class="ra-rc-label" style="margin-top:1rem">AI suggested keywords</h4>
                        <div class="ra-rc-chip-row">
                            <span class="ra-rc-chip ra-rc-chip--ai">Outcome-driven</span>
                            <span class="ra-rc-chip ra-rc-chip--ai">Sprint planning</span>
                            <span class="ra-rc-chip ra-rc-chip--ai">Go-to-market</span>
                        </div>
                        <h4 class="ra-rc-label" style="margin-top:1rem">Industry keywords</h4>
                        <div class="ra-rc-chip-row">
                            <span class="ra-rc-chip ra-rc-chip--ind">SaaS</span>
                            <span class="ra-rc-chip ra-rc-chip--ind">B2B</span>
                            <span class="ra-rc-chip ra-rc-chip--ind">Agile</span>
                            <span class="ra-rc-chip ra-rc-chip--ind">CI/CD</span>
                        </div>
                    </div>

                    <div class="ra-rc-mt ra-rc-reveal" id="ra-rc-suggestions">
                        <h3 class="ra-rc-section-title" style="font-size:1.15rem">AI improvement suggestions</h3>
                        <p class="ra-rc-section-sub">Prioritized upgrades ranked by estimated impact on your ATS pass rate.</p>
                        <div class="ra-rc-suggest-grid">
                            <article class="ra-rc-suggest">
                                <div class="ra-rc-suggest__icon" aria-hidden="true">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                </div>
                                <h4>Add professional summary</h4>
                                <p>Open with a tight 3-line summary that mirrors the role title and top keywords from the JD.</p>
                                <div class="ra-rc-suggest__pct">Est. impact +18%</div>
                            </article>
                            <article class="ra-rc-suggest">
                                <div class="ra-rc-suggest__icon" aria-hidden="true">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                                </div>
                                <h4>Improve project descriptions</h4>
                                <p>Lead each bullet with a strong verb, scope, and quantified result (%, revenue, latency).</p>
                                <div class="ra-rc-suggest__pct">Est. impact +14%</div>
                            </article>
                            <article class="ra-rc-suggest">
                                <div class="ra-rc-suggest__icon" aria-hidden="true">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>
                                </div>
                                <h4>Add measurable achievements</h4>
                                <p>Replace vague duties with metrics: adoption, NPS, cycle time, cost saved, team size led.</p>
                                <div class="ra-rc-suggest__pct">Est. impact +22%</div>
                            </article>
                            <article class="ra-rc-suggest">
                                <div class="ra-rc-suggest__icon" aria-hidden="true">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                </div>
                                <h4>Use action verbs</h4>
                                <p>Swap weak phrases for verbs like spearheaded, orchestrated, negotiated, automated.</p>
                                <div class="ra-rc-suggest__pct">Est. impact +9%</div>
                            </article>
                            <article class="ra-rc-suggest">
                                <div class="ra-rc-suggest__icon" aria-hidden="true">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                                </div>
                                <h4>Improve formatting</h4>
                                <p>Keep one column, standard fonts, and avoid icons or tables that confuse legacy ATS parsers.</p>
                                <div class="ra-rc-suggest__pct">Est. impact +11%</div>
                            </article>
                        </div>
                    </div>

                    <div class="ra-rc-mt ra-rc-reveal">
                        <h3 class="ra-rc-section-title" style="font-size:1.15rem">ATS friendly checklist</h3>
                        <div class="ra-rc-checklist">
                            <div class="ra-rc-check-item ra-rc-check-item--ok"><span class="ra-rc-check-item__dot"></span><span>Contact information visible in header block</span></div>
                            <div class="ra-rc-check-item ra-rc-check-item--ok"><span class="ra-rc-check-item__dot"></span><span>Dedicated skills section present</span></div>
                            <div class="ra-rc-check-item ra-rc-check-item--ok"><span class="ra-rc-check-item__dot"></span><span>Experience with reverse-chronological entries</span></div>
                            <div class="ra-rc-check-item ra-rc-check-item--bad"><span class="ra-rc-check-item__dot"></span><span>Education section  -  add expected graduation or GPA if early career</span></div>
                            <div class="ra-rc-check-item ra-rc-check-item--ok"><span class="ra-rc-check-item__dot"></span><span>Proper formatting (single column, no text boxes)</span></div>
                            <div class="ra-rc-check-item ra-rc-check-item--ok"><span class="ra-rc-check-item__dot"></span><span>ATS readable structure (standard headings)</span></div>
                        </div>
                    </div>

                    <div class="ra-rc-mt ra-rc-reveal">
                        <h3 class="ra-rc-section-title" style="font-size:1.15rem">AI features</h3>
                        <div class="ra-rc-features">
                            <article class="ra-rc-feature">
                                <div class="ra-rc-suggest__icon" aria-hidden="true"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 1v2m0 18v2M4.22 4.22l1.42 1.42m12.72 12.72 1.42 1.42"/></svg></div>
                                <h4>AI resume analysis</h4>
                                <p>Deep read of structure, tone, and keyword density tuned for hiring pipelines.</p>
                            </article>
                            <article class="ra-rc-feature">
                                <div class="ra-rc-suggest__icon" aria-hidden="true"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg></div>
                                <h4>ATS score checker</h4>
                                <p>Weighted scoring inspired by leading applicant tracking systems.</p>
                            </article>
                            <article class="ra-rc-feature">
                                <div class="ra-rc-suggest__icon" aria-hidden="true"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg></div>
                                <h4>Job match analyzer</h4>
                                <p>Side-by-side overlap between your resume and the pasted job description.</p>
                            </article>
                            <article class="ra-rc-feature">
                                <div class="ra-rc-suggest__icon" aria-hidden="true"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7h16M4 12h10M4 17h14"/></svg></div>
                                <h4>Keyword optimization</h4>
                                <p>Surface missing phrases and suggest natural insertions.</p>
                            </article>
                            <article class="ra-rc-feature">
                                <div class="ra-rc-suggest__icon" aria-hidden="true"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg></div>
                                <h4>Grammar improvement</h4>
                                <p>Clarity and conciseness passes for global hiring audiences.</p>
                            </article>
                            <article class="ra-rc-feature">
                                <div class="ra-rc-suggest__icon" aria-hidden="true"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
                                <h4>Resume enhancement</h4>
                                <p>Guided rewrites for summary, bullets, and skills alignment.</p>
                            </article>
                        </div>
                    </div>

                    <div class="ra-rc-stats ra-rc-reveal">
                        <div class="ra-rc-stat">
                            <div class="ra-rc-stat__num" id="ra-rc-stat-1">0</div>
                            <div class="ra-rc-stat__label">Resumes scanned (demo)</div>
                        </div>
                        <div class="ra-rc-stat">
                            <div class="ra-rc-stat__num" id="ra-rc-stat-2">0%</div>
                            <div class="ra-rc-stat__label">Avg match lift</div>
                        </div>
                        <div class="ra-rc-stat">
                            <div class="ra-rc-stat__num"><span id="ra-rc-stat-3">0</span> sec</div>
                            <div class="ra-rc-stat__label">Avg analysis time</div>
                        </div>
                        <div class="ra-rc-stat">
                            <div class="ra-rc-stat__num" id="ra-rc-stat-4">0</div>
                            <div class="ra-rc-stat__label">Templates optimized</div>
                        </div>
                    </div>

                    <?php if (!empty($top_jobs)): ?>
                    <div class="ra-rc-mt ra-rc-reveal">
                        <h3 class="ra-rc-section-title" style="font-size:1.15rem">Recommended Jobs based on your profile</h3>
                        <p class="ra-rc-section-sub">These opportunities match your skills and ATS score.</p>
                        <div class="ra-rc-suggest-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                            <?php foreach ($top_jobs as $job): ?>
                            <article class="ra-rc-suggest" style="cursor: pointer; display: flex; flex-direction: column;" onclick="window.location.href='<?= $this->session->userdata('logged_in') ? base_url('dashboard') : base_url('register'); ?>'">
                                <div style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.5rem;">
                                    <div style="width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg, #f59e0b, #d97706); color: white; display: grid; place-items: center; font-weight: bold; font-size: 0.8rem;">
                                        <?= htmlspecialchars($job->logo_text ?: 'JO', ENT_QUOTES, 'UTF-8'); ?>
                                    </div>
                                    <h4 style="margin: 0; flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 1rem;"><?= htmlspecialchars($job->title, ENT_QUOTES, 'UTF-8'); ?></h4>
                                </div>
                                <p style="font-size: 0.85rem; color: var(--ra-rc-muted); margin: 0 0 1rem 0; flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <?= htmlspecialchars($job->company, ENT_QUOTES, 'UTF-8'); ?> &bull; <?= htmlspecialchars($job->location ?: 'Anywhere', ENT_QUOTES, 'UTF-8'); ?>
                                </p>
                                <div style="display: flex; gap: 0.5rem;">
                                    <?php if (!empty($job->type)): ?>
                                        <div class="ra-rc-suggest__pct" style="margin-top:0; align-self: flex-start; background: rgba(245, 158, 11, 0.12); color: #d97706; border: 1px solid rgba(245, 158, 11, 0.35); padding: 0.2rem 0.6rem;">
                                            <?= htmlspecialchars($job->type, ENT_QUOTES, 'UTF-8'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($job->is_remote): ?>
                                        <div class="ra-rc-suggest__pct" style="margin-top:0; align-self: flex-start; background: rgba(16, 185, 129, 0.12); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.35); padding: 0.2rem 0.6rem;">
                                            Remote
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </article>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                   

                  

                 

                    <div class="ra-rc-mt ra-rc-reveal">
                        <h3 class="ra-rc-section-title" style="font-size:1.15rem">Resume tips</h3>
                        <div class="ra-rc-tips-grid">
                            <div class="ra-rc-tip-card"><strong>Mirror the JD</strong> Echo important nouns and phrases naturally in your summary and skills.</div>
                            <div class="ra-rc-tip-card"><strong>Quantify everything</strong> Even estimated impact beats no numbers for ATS and humans.</div>
                            <div class="ra-rc-tip-card"><strong>File naming</strong> Use FirstName_LastName_Resume.pdf for cleaner recruiter workflows.</div>
                            <div class="ra-rc-tip-card"><strong>Plain layout wins</strong> Creative columns often break parsers  -  keep it simple for first screens.</div>
                        </div>
                    </div>

                    <div class="ra-rc-mt ra-rc-reveal">
                        <h3 class="ra-rc-section-title" style="font-size:1.15rem">FAQ</h3>
                        <div class="ra-rc-faq">
                            <details>
                                <summary>Is my resume stored securely?</summary>
                                <div>Demo mode runs in your browser session. Production should use encrypted uploads and retention policies you disclose in privacy terms.</div>
                            </details>
                            <details>
                                <summary>How accurate is the ATS score?</summary>
                                <div>Real ATS engines vary by employer. This UI demonstrates the experience; wire your own scoring API for production accuracy.</div>
                            </details>
                            <details>
                                <summary>Do I need a job description?</summary>
                                <div>Scores work without one, but pasting a JD unlocks richer keyword and match insights in this flow.</div>
                            </details>
                            <details>
                                <summary>Can I download a report?</summary>
                                <div>Yes  -  use Download ATS Report after analysis for a text summary (extend to PDF on the server).</div>
                            </details>
                        </div>
                    </div>
                </section>
            </div>

            <aside class="ra-rc-aside ra-rc-preview ra-rc-reveal">
                <div class="ra-rc-card ra-rc-card--light">
                    <h3 class="ra-rc-card__title" style="color:#0f172a">Resume preview</h3>
                    <div class="ra-rc-preview__thumb" aria-hidden="true">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <div class="ra-rc-preview__meta">
                        <p><strong>File</strong><br><span id="ra-rc-aside-filename">No file yet</span></p>
                        <p><strong>Size</strong><br><span id="ra-rc-aside-size">-</span></p>
                        <p><strong>Uploaded</strong><br><span id="ra-rc-aside-date">-</span></p>
                    </div>
                    <div class="ra-rc-preview__actions">
                        <button type="button" class="ra-rc-btn ra-rc-btn--primary ra-rc-btn--sm" id="ra-rc-btn-download" disabled>Download ATS Report</button>
                        <button type="button" class="ra-rc-btn ra-rc-btn--ghost ra-rc-btn--sm" id="ra-rc-btn-reupload" disabled>Re-upload</button>
                        <a href="<?= htmlspecialchars($bu . 'dashboard', ENT_QUOTES, 'UTF-8'); ?>" class="ra-rc-btn ra-rc-btn--outline ra-rc-btn--sm disabled" id="ra-rc-btn-recheck-app" style="text-align:center" disabled>Recheck in app</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <div class="ra-rc-loading" id="ra-rc-loading" role="dialog" aria-modal="true" aria-labelledby="ra-rc-loading-title">
        <div class="ra-rc-loading__card">
            <div class="ra-rc-loading__spinner" aria-hidden="true"></div>
            <h3 id="ra-rc-loading-title">AI is scanning your resume</h3>
            <p class="ra-rc-loading__step" id="ra-rc-loading-step">Preparing...</p>
            <div class="ra-rc-loading__dots" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span></div>
        </div>
    </div>
</div>




