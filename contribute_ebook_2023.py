import os
import random
import subprocess
from datetime import datetime, timedelta

# ---------------------
# Settings
# ---------------------

REPO_PATH = "."  # Run from within Ebook repo
FILENAME = "data.txt"  # A dummy file to modify
NUM_COMMITS = 50  # Adjust how many commits you want
BRANCH_NAME = "main"  # Or "master" depending on your repo
COMMIT_MESSAGES = [
    "feat: add login system with PHP session",
    "fix: correct SQL query in book.php",
    "style: improve book detail card UI",
    "refactor: split header and footer into includes",
    "chore: clean unused images",
    "feat: add user registration form",
    "fix: resolve CSS issues on mobile",
    "feat: implement book search by category",
    "refactor: move db connection to config.php",
    "test: test book pagination logic",
    "docs: update README with setup instructions",
    "fix: broken book cover image link",
    "feat: add admin dashboard for managing books",
    "style: change font to Roboto for readability",
    "chore: organize assets into folders",
    "feat: implement add-to-library button",
    "fix: MySQL INSERT query issue",
    "refactor: simplify index.php logic",
    "docs: add database schema diagram",
    "fix: login error handling",
]

# ---------------------
# Utils
# ---------------------

def random_date_in_2023():
    start_date = datetime(2023, 1, 1)
    end_date = datetime(2023, 12, 31, 23, 59, 59)
    delta = end_date - start_date
    random_seconds = random.randint(0, int(delta.total_seconds()))
    return start_date + timedelta(seconds=random_seconds)

def make_commit(date, repo_path, filename, message):
    filepath = os.path.join(repo_path, filename)
    with open(filepath, "a") as f:
        f.write(f"Commit on {date.isoformat()} - {message}\n")
    subprocess.run(["git", "add", filename], cwd=repo_path)
    env = os.environ.copy()
    date_str = date.strftime("%Y-%m-%dT%H:%M:%S")
    env["GIT_AUTHOR_DATE"] = date_str
    env["GIT_COMMITTER_DATE"] = date_str
    subprocess.run(["git", "commit", "-m", message], cwd=repo_path, env=env)

# ---------------------
# Main Logic
# ---------------------

def main():
    print("📚 Starting fake contribution commits for 'Ebook' project (2023)...\n")

    for i in range(NUM_COMMITS):
        commit_date = random_date_in_2023()
        message = random.choice(COMMIT_MESSAGES)
        print(f"[{i+1}/{NUM_COMMITS}] Commit on {commit_date.strftime('%Y-%m-%d %H:%M:%S')} — {message}")
        make_commit(commit_date, REPO_PATH, FILENAME, message)

    print("\n🚀 Pushing to GitHub...")
    subprocess.run(["git", "push", "origin", BRANCH_NAME], cwd=REPO_PATH)

    print("\n✅ Done! Contributions will appear on your GitHub graph soon.")

if __name__ == "__main__":
    main()
