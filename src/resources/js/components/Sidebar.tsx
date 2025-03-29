import React, { useState } from "react";
import "../styles/Sidebar.css";
import "@fortawesome/fontawesome-free/css/all.css";
import axios from "axios";

const Sidebar: React.FC = () => {
    const [isHovered, setIsHovered] = useState<boolean>(false);

    const handleLogout = async () => {
        try {
            await axios.post("/logout", {}, {
                headers: {
                    "X-CSRF-TOKEN": (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement)?.content || ""
                },
                withCredentials: true // Fortify を使用する場合、これを true にする必要がある！
            });
            window.location.href = "/login"; // ログアウト後のリダイレクト先
        } catch (error) {
            console.error("ログアウトに失敗しました。", error);
        }
    };

    return (
        <div
            className="sidebar-container"
            onMouseEnter={() => setIsHovered(true)}
            onMouseLeave={() => setIsHovered(false)}
        >
            <div className={`sidebar ${isHovered ? "visible" : "hidden"}`}>
                <div className="index_nav">
                    <a className={`index_link ${isHovered ? "hovered" : ""}`} href="/">
                        <i className="fas fa-home"></i> ホーム
                    </a>
                    <a className={`attendance_link ${isHovered ? "hovered" : ""}`} href="/attendance">
                        <i className="fas fa-plus"></i> 日付別勤怠情報
                    </a>
                    <a className={`user_list_link ${isHovered ? "hovered" : ""}`} href={`/users`}>
                        <i className="fas fa-user"></i> ユーザー一覧
                    </a>
                    <button className="nav_button" onClick={handleLogout}>
                        Logout
                    </button>
                </div>
            </div>
            <div className="arrow">&larr;</div>
        </div>
    );
};

export default Sidebar;
