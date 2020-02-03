<% if $CanAccess %>
  <a href="/admin/pages/edit/show/{$ID}" target="_blank" rel="noopener noreferrer" class="page__envbar page__envbar--link page__envbar--<% if $Environment != '' %>{$Environment}<% else %>live<% end_if %>">
    Logged in as <strong>{$CurrentMember.FirstName.UpperCase}</strong> viewing the <strong>{$PageStatus.UpperCase}</strong> version of this page in the <strong><% if $Environment != '' %>{$Environment.UpperCase}<% else %>LIVE<% end_if %></strong> environment.<br>
    This bar will not be visible to unauthorised users when live. Click to <strong>EDIT</strong> in new tab.
  </a>
<% else_if $Environment != '' %>
  <span class="page__envbar page__envbar--{$Environment}">
    You are viewing the <strong>{$PageStatus.UpperCase}</strong> version of this page in the <strong>{$Environment.UpperCase}</strong> environment.<br>
    This bar will not be visible to unauthorised users when live.
  </span>
<% end_if %>